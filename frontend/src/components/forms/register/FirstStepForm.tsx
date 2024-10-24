import {Tabs, TabsList, TabsTrigger} from "@/components/ui/tabs.tsx";
import {Label} from "@/components/ui/label.tsx";
import {Input} from "@/components/ui/input.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction, useRef} from "react";
import {useForm} from "react-hook-form";
import {ErrorMessage} from "@hookform/error-message";
import {IRegisterData} from "@/hooks/useRegister.ts";

interface Inputs {
    name: string;
    password: string;
    confirm_password: string;
    email: string;
    age: string;
    phone_number: string;
}

interface IFirstStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterData>>,
    fullFormData: IRegisterData
}

export default function FirstStepForm({setActualStep, setFullFormData, fullFormData}: IFirstStepForm) {

    const maxDate = new Date().toISOString().split("T")[0]
    const {register, handleSubmit, formState, getValues} = useForm<Inputs>()
    const {errors} = formState
    const inNeedTabRef = useRef<HTMLButtonElement | null>(null)

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
                    <Input defaultValue={fullFormData.name}
                           id="name" {...register("name", {required: "Uzupełnij nazwę użytkownika"})}/>
                    <ErrorMessage name="name" errors={errors}
                                  render={({message}) => <p className="text-red-500">{message}</p>}/>
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
                    <ErrorMessage name="email" errors={errors}
                                  render={({message}) => <p className="text-red-500">{message}</p>}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="password">Hasło</Label>
                    <Input defaultValue={fullFormData.password} id="password"
                           type="password" {...register("password", {
                        required: "Uzupełnij hasło",
                        minLength: {
                            value: 6,
                            message: "Hasło musi mieć co najmniej 6 znaków"
                        },
                    })}/>
                    <ErrorMessage name="password" errors={errors}
                                  render={({message}) => <p className="text-red-500">{message}</p>}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="confirmPassword">Powtórz Hasło</Label>
                    <Input id="confirmPassword" type="password" {...register("confirm_password", {
                        required: "Powtórz hasło",
                        validate: value => value === getValues("password") || "Hasła nie są takie same"
                    })}/>
                    <ErrorMessage name="confirm_password" errors={errors}
                                  render={({message}) => <p className="text-red-500">{message}</p>}/>
                </div>
            </div>
            <div className="grid sm:grid-cols-2 gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="age">Data urodzenia</Label>
                    <Input defaultValue={fullFormData.age} id="age" type="date" min="1899-01-01"
                           max={maxDate} {...register("age", {
                        required: "Uzupełnij wiek",
                        min: {
                            value: "1899-01-01",
                            message: "Wprowadź poprawny wiek"
                        },
                        max: {
                            value: maxDate,
                            message: "Wprowadź poprawny wiek"
                        }
                    })}/>
                </div>
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="phone">Numer Telefonu</Label>
                    <Input defaultValue={fullFormData.phone_number} id="phone" type="tel" {...register("phone_number", {
                        required: "Uzupełnij numer telefonu",
                        minLength: 10,
                        pattern: {
                            value: /^([0-9\s-+()]*)$/,
                            message: "Wprowadź poprawny numer telefonu (9-15 cyfr)"
                        }
                    })} />
                </div>
            </div>
            <div>
                <ErrorMessage name="age" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
                <ErrorMessage name="phone_number" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
            </div>
            <Button
                className="bg-violet-600 font-bold hover:bg-violet-700">
                Dalej
            </Button>
        </form>
    )
}
