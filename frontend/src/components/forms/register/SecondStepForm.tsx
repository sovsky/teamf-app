import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select.tsx";
import {MultiSelect} from "@/components/ui/multi-select.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction} from "react";
import {ICity, IHelpType, IVoivodeship} from "@/pages/Register.tsx";
import {useForm} from "react-hook-form";
import {ErrorMessage} from "@hookform/error-message";
import {IRegisterData} from "@/hooks/useRegister.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";


interface ISecondStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterData>>,
    fullFormData: IRegisterData,
    cities: ICity[],
    voivodeships:IVoivodeship[],
    helpTypes: IHelpType[],
    submitHandler: (data: IRegisterData) => void,
    status: "success" | "error" | "pending" | "idle",
}

interface Inputs {
    voivodeship:string;
    city: string;
    helpTypes: string[];
}

export default function SecondStepForm({
                                           setActualStep,
                                           voivodeships,
                                           setFullFormData,
                                           fullFormData,
                                           cities,
                                           helpTypes,
                                           submitHandler, status
                                       }: ISecondStepForm) {

    const {register, handleSubmit, formState, setValue} = useForm<Inputs>()
    const {errors} = formState
    const disable = status === "pending"

    const onSubmit = (data: Inputs) => {
        setFullFormData(prevState => {
            const actualData = {
                ...prevState,
                ...data
            }

            submitHandler(actualData)

            return actualData
        })
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6">
                        <Select onValueChange={(value) => setValue("voivodeship", value)}
                    defaultValue={fullFormData.voivodeship} {...register("voivodeship", {required: "Wybierz województwo"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz województwo"/>
                </SelectTrigger>
                <SelectContent>
                    {voivodeships.map((voivodeship) => {
                        const isDisabled = voivodeship.value ==="Brak danych"
                        return (
                            <SelectItem disabled={isDisabled} key={voivodeship.id} value={voivodeship.value}>{voivodeship.value}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>
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
                <Button className="border-gray-400 hover:bg-gray-500 bg-gray-400 text-white font-semibold border-2"
                        onClick={() => {
                            setActualStep(prevState => prevState - 1)
                        }}>Cofnij</Button>
                <Button type="submit" disabled={disable}
                        className="w-full bg-violet-600 font-bold hover:bg-violet-700">
                    {disable ? <CircleSpinner/> : "Zarejestruj"}
                </Button>
            </div>
        </form>
    )
}
