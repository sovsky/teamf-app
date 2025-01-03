import {Tabs, TabsList, TabsTrigger} from "@/components/ui/tabs.tsx";
import {Label} from "@/components/ui/label.tsx";
import {Input} from "@/components/ui/input.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction} from "react";
import {useForm} from "react-hook-form";
import {ErrorMessage} from "@hookform/error-message";
import {AccountType, IRegisterData} from "@/hooks/useRegister.ts";
import {useSearchParams} from "react-router-dom";
import useRegisterAdmin from "@/hooks/useRegisterAdmin";
import CircleSpinner from "@/components/CircleSpinner";

interface Inputs {
    name: string;
    password: string;
    password_confirmation: string;
    email: string;
    age: string;
    phone_number: string;
    city:string;
}

interface IFirstStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterData>>,
    fullFormData: IRegisterData
}

export default function RegisterAdmin({setActualStep, setFullFormData, fullFormData}: IFirstStepForm) {


const {submitHandler,errorMessage,isPending}= useRegisterAdmin();
    const maxDate = new Date().toISOString().split("T")[0]
    const {register, handleSubmit, formState, getValues} = useForm<Inputs>()
    const {errors} = formState



   

    const onSubmit = (data: Inputs) => {
    
        submitHandler(data)

        }


    

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6 py-5 px-2">
            {/* <Tabs defaultValue={getRole()} className="py-2">
                <TabsList className="grid w-full grid-cols-2">
                    <TabsTrigger onClick={() => setRole("inNeed")} className="data-[state=active]:bg-violet-300"
                                 value="inNeed">Potrzebujący</TabsTrigger>
                    <TabsTrigger onClick={() => setRole("volunteer")} className="data-[state=active]:bg-violet-300"
                                 value="volunteer">Wolontariusz</TabsTrigger>
                </TabsList>
            </Tabs> */}
            
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="name">Imię</Label>
                    <Input defaultValue={fullFormData.name}
                           id="name" {...register("name", {required: "Uzupełnij nazwę użytkownika"})}/>
                    <ErrorMessage name="name" errors={errors}
                                  render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
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
                                  render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
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
                                  render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="confirmPassword">Powtórz Hasło</Label>
                    <Input id="confirmPassword" type="password" {...register("password_confirmation", {
                        required: "Powtórz hasło",
                        validate: value => value === getValues("password") || "Hasła nie są takie same"
                    })}/>
                    <ErrorMessage name="password_confirmation" errors={errors}
                                  render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
                </div>
            </div>
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="city">Miejscowość</Label>
                    <Input id="city" {...register("city",  {
                        required: "Uzupełnij miejscowość",
                        minLength: {
                            value: 2,
                            message: "Miejscowość musi mieć co najmniej 6 znaków"
                        },
                    })}/>
                    <ErrorMessage name="city" errors={errors}
                                  render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
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
            <div className="grid sm:grid-cols-2 gap-6">
                <ErrorMessage name="age" errors={errors}
                              render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
                <ErrorMessage name="phone_number" errors={errors}
                              render={({message}) => <p className="text-red-500 text-sm">{message}</p>}/>
            </div>
          
            <Button
            disabled={isPending}
              >
          {isPending ? <CircleSpinner/> : "   Utwórz konto"}
            </Button>
 { errorMessage &&  <span className="text-center text-red-600 text-sm bg-red-100 rounded-lg p-2">{errorMessage}</span>}
        </form>
    )
}
