import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select.tsx";
import {MultiSelect} from "@/components/ui/multi-select.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction} from "react";
import {ICity, IHelpType, IRegisterForm} from "@/pages/Register.tsx";
import {useForm} from "react-hook-form";
import {ErrorMessage} from "@hookform/error-message";

interface ISecondStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterForm>>,
    fullFormData: IRegisterForm,
    cities: ICity[],
    helpTypes: IHelpType[]
}

interface Inputs {
    city: string,
    helpTypes: string[]
}

export default function SecondStepForm({
                                           setActualStep,
                                           setFullFormData,
                                           fullFormData,
                                           cities,
                                           helpTypes
                                       }: ISecondStepForm) {

    const {register, handleSubmit, formState, setValue} = useForm<Inputs>()
    const {errors} = formState

    const onSubmit = (data: Inputs) => {
        setFullFormData(prevState => {
            return {
                ...prevState,
                ...data
            }
        })
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6">
            <Select onValueChange={(value) => setValue("city", value)}
                    defaultValue={fullFormData.city} {...register("city", {required: "Wybierz miasto"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz miasto"/>
                </SelectTrigger>
                <SelectContent>
                    {cities.map((city) => {
                        return (
                            <SelectItem key={city.id} value={city.value}>{city.value}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>
            <MultiSelect defaultValue={fullFormData.helpTypes} placeholder="Wybierz formy pomocy" options={helpTypes}
                         {...register("helpTypes", {required: "Wybierz odpowiadające formy pomocy"})}
                         onValueChange={(value) => {
                             setValue("helpTypes", value)
                         }}/>
            <div>
                <ErrorMessage name="city" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
                <ErrorMessage name="helpTypes" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
            </div>
            <div className="flex gap-2">
                <Button className="border-gray-400 hover:bg-gray-500 bg-gray-400 text-white font-semibold border-2" onClick={() => {
                    setActualStep(prevState => prevState - 1)
                }}>Cofnij</Button>
                <Button type="submit"
                        className="w-full bg-violet-600 font-bold hover:bg-violet-700">Zarejestruj</Button>
            </div>
        </form>
    )
}
