import {ErrorMessage} from "@hookform/error-message";
import {Button} from "@/components/ui/button.tsx";
import {useForm} from "react-hook-form";
import {Label} from "@/components/ui/label.tsx";
import {Input} from "@/components/ui/input.tsx";
import useLogin from "@/hooks/useLogin.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";

export interface LoginInputs {
    email: string;
    password: string;
}

export default function LoginForm() {

    const {register, formState, handleSubmit} = useForm<LoginInputs>()
    const {errors} = formState
    const {mutate, status} = useLogin()
    const disabled = status === "pending"

    const onSubmit = (data: LoginInputs) => {
        mutate(data)
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6">
            <div className="grid sm:grid-flow-col gap-6">
                <div className="grid w-full items-center gap-1.5">
                    <Label htmlFor="email">Email</Label>
                    <Input id="email" type="email" {...register("email", {
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
                    <Input id="password" type="password" {...register("password", {
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
            <Button type="submit" disabled={disabled}
                    className="w-full bg-violet-600 font-bold hover:bg-violet-700">
                {disabled ? <CircleSpinner/> : "Zaloguj się"}
            </Button>
        </form>
    )
}
