import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select.tsx";
import {Button} from "@/components/ui/button.tsx";
import {Dispatch, SetStateAction} from "react";
import {useForm} from "react-hook-form";
import {ErrorMessage} from "@hookform/error-message";
import {IRegisterData} from "@/hooks/useRegister.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";
import {AxiosResponse} from "axios";
import {IVoivodeship} from "@/pages/Register.tsx";
import getDistricts from "@/lib/api/getDistricts.ts";
import getCommunes from "@/lib/api/getCommunes.ts";
import getCities from "@/lib/api/getCities.ts";
import useAdministrationPlace from "@/hooks/useAdministrationPlace.ts";


interface ISecondStepForm {
    setActualStep: Dispatch<SetStateAction<number>>,
    setFullFormData: Dispatch<SetStateAction<IRegisterData>>,
    voivodeshipsRes: AxiosResponse | undefined,
    submitHandler: (data: IRegisterData) => void,
    status: "success" | "error" | "pending" | "idle",
}

interface Inputs {
    voivodeship: string;
    district: string;
    commune: string;
    city: string;
}

export default function SecondStepForm({
                                           setActualStep,
                                           voivodeshipsRes,
                                           setFullFormData,
                                           submitHandler, status
                                       }: ISecondStepForm) {

    const {register, handleSubmit, formState, setValue, clearErrors, watch} = useForm<Inputs>()
    const {errors} = formState
    const disable = status === "pending"

    const watchVoivodeship = watch("voivodeship")
    const watchDistrict = watch("district")
    const watchCommune = watch("commune")

    const {res: districtsRes} = useAdministrationPlace({
        mutationKey: ['districts'],
        mutationFn: getDistricts,
        watchValue: watchVoivodeship
    })
    const {res: communesRes} = useAdministrationPlace({
        mutationKey: ["communes"],
        mutationFn: getCommunes,
        watchValue: watchDistrict
    })
    const {res: citiesRes} = useAdministrationPlace({
        mutationKey: ["cities"],
        mutationFn: getCities,
        watchValue: watchCommune
    })

    const onSubmit = (data: Inputs) => {
        setFullFormData(prevState => {
            const actualData = {
                ...prevState,
                city_id: parseInt(data.city)
            }

            submitHandler(actualData)

            return actualData
        })
    }

    if (!voivodeshipsRes || !voivodeshipsRes.data) {
        return <CircleSpinner/>
    }

    return (
        <form onSubmit={handleSubmit(onSubmit)} className="flex flex-col gap-6">
            <Select onValueChange={(value) => {
                clearErrors("voivodeship")
                setValue("voivodeship", value)
                setValue("district", "")
                setValue("commune", "")
                setValue("city", "")
            }}
                    {...register("voivodeship", {required: "Wybierz województwo"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz województwo"/>
                </SelectTrigger>
                <SelectContent>
                    {voivodeshipsRes.data.data.map((voivodeship: IVoivodeship) => {
                        const isDisabled = voivodeship.name === "Brak danych"
                        return (
                            <SelectItem disabled={isDisabled} key={voivodeship.id}
                                        value={voivodeship.id.toString()}>{voivodeship.name}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>

            <Select disabled={!watchVoivodeship} onValueChange={(value) => {
                clearErrors("district")
                setValue("district", value)
                setValue("commune", "")
                setValue("city", "")
            }}
                    {...register("district", {required: "Wybierz powiat"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz powiat"/>
                </SelectTrigger>
                <SelectContent>
                    {districtsRes && districtsRes.data.data.map((district: IVoivodeship) => {
                        const isDisabled = district.name === "Brak danych"
                        return (
                            <SelectItem disabled={isDisabled} key={district.id}
                                        value={district.id.toString()}>{district.name}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>

            <Select disabled={!watchDistrict} onValueChange={(value) => {
                clearErrors("commune")
                setValue("commune", value)
                setValue("city", "")
            }}
                    {...register("commune", {required: "Wybierz gminę"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz gminę"/>
                </SelectTrigger>
                <SelectContent>
                    {communesRes && communesRes.data.data.map((commune: IVoivodeship) => {
                        const isDisabled = commune.name === "Brak danych"
                        return (
                            <SelectItem disabled={isDisabled} key={commune.id}
                                        value={commune.id.toString()}>{commune.name}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>

            <Select disabled={!watchCommune} onValueChange={(value) => {
                clearErrors("city")
                setValue("city", value)
            }}
                    {...register("city", {required: "Wybierz miejscowość"})}>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz miejscowość"/>
                </SelectTrigger>
                <SelectContent>
                    {citiesRes && citiesRes.data.data.map((cities: IVoivodeship) => {
                        const isDisabled = cities.name === "Brak danych"
                        return (
                            <SelectItem disabled={isDisabled} key={cities.id}
                                        value={cities.id.toString()}>{cities.name}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>

            <div>
                <ErrorMessage name="voivodeship" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
                <ErrorMessage name="district" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
                <ErrorMessage name="commune" errors={errors}
                              render={({message}) => <p className="text-red-500">{message}</p>}/>
                <ErrorMessage name="city" errors={errors}
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
