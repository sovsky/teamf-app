import {Tabs, TabsList, TabsTrigger} from "@/components/ui/tabs.tsx";
import {Label} from "@/components/ui/label.tsx";
import {Input} from "@/components/ui/input.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction, useEffect, useRef} from "react";
import {useForm} from "react-hook-form";
import {IRegisterForm} from "@/pages/Register.tsx";

interface Inputs {
    name: string;
    password: string;
    email: string;
    age: number;
    phone: string;
}

interface IFirstStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterForm>>,
    fullFormData: IRegisterForm
}

export default function FirstStepForm({setActualStep, setFullFormData, fullFormData}: IFirstStepForm) {

    const {register, handleSubmit, formState, getFieldState} = useForm<Inputs>()
    const {invalid: passwordIsInvalid} = getFieldState("password", formState)
    const inNeedTabRef = useRef<HTMLButtonElement | null>(null)

    useEffect(() => {
        console.log(passwordIsInvalid)
    }, [formState]);

    const getAccountType = (): "inNeed" | "helper" => {
        if (inNeedTabRef.current?.getAttribute("data-state") === "active") {
            return "inNeed"
        }

        return "helper"
    }

    const onSubmit = (data: Inputs) => {
        const accountType = getAccountType()

        // save data from first step form to fullFormData state
        setFullFormData(prevState => {
            return {
                ...prevState,
                ...data,
                accountType
            }
        })

        // go to next form step
        setActualStep(prevState => prevState + 1)
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6">
            <Tabs defaultValue={fullFormData.accountType} className="py-2">
                <TabsList className="grid w-full grid-cols-2">
                    <TabsTrigger ref={inNeedTabRef} className="data-[state=active]:bg-violet-300"
                                 value="inNeed">Potrzebujący</TabsTrigger>
                    <TabsTrigger className="data-[state=active]:bg-violet-300"
                                 value="helper">Wolontariusz</TabsTrigger>
                </TabsList>
            </Tabs>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="name">Imię</Label>
                    <Input defaultValue={fullFormData.name} isValid={true}
                           id="name" {...register("name", {required: "Uzupełnij nazwę użytkownika"})}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="email">Email</Label>
                    <Input defaultValue={fullFormData.email} id="email" type="email" {...register("email", {
                        required: "Uzupełnij adres email", pattern: {
                            value: /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                            message: 'Wprowadź poprawny adres email',
                        },
                    })}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="password">Hasło</Label>
                    <Input isValid={!passwordIsInvalid} defaultValue={fullFormData.password} id="password"
                           type="password" {...register("password", {
                        required: "Uzupełnij hasło",
                        minLength: {
                            value: 8,
                            message: "Hasło musi mieć co najmniej 8 znaków"
                        },
                        pattern: {
                            value: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/,
                            message: "Hasło musi zawierać co najmniej jedną literę i jedną cyfrę"
                        }
                    })}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full max-w-sm items-center gap-1.5">
                    <Label htmlFor="age">Wiek</Label>
                    <Input defaultValue={fullFormData.age} id="age" type="number" min="0" max="99" {...register("age", {
                        required: "Uzupełnij wiek",
                        min: {
                            value: 0,
                            message: "Wprowadź poprawny wiek"
                        },
                        max: {
                            value: 99,
                            message: "Wprowadź poprawny wiek"
                        }
                    })}/>
                </div>
                <div className="grid w-full max-w-sm items-center gap-1.5">
                    <Label htmlFor="phone">Numer Telefonu</Label>
                    <Input defaultValue={fullFormData.phone} id="phone" type="tel" {...register("phone", {
                        required: "Uzupełnij numer telefonu",
                        pattern: {
                            value: /^[0-9]{9,15}$/,
                            message: "Wprowadź poprawny numer telefonu (9-15 cyfr)"
                        }
                    })} />
                </div>
            </div>
            <Button disabled={(!formState.isValid)}
                    className="bg-violet-600 font-bold hover:bg-violet-700 mt-auto">
                Dalej
            </Button>
        </form>
    )
}
