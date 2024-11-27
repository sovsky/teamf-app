import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {AxiosResponse} from "axios";
import {IGetAidResponse} from "@/lib/api/getAidCategories.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";
import {useForm} from "react-hook-form";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select.tsx";
import {Button} from "@/components/ui/button.tsx";
import {useMutation} from "@tanstack/react-query";
import saveUserAid from "@/lib/api/saveUserAid.ts";

interface IUserAidInformationCard {
    data: AxiosResponse<IGetAidResponse, string> | undefined
    status: "error" | "idle" | "pending" | "success"
}

interface Inputs {
    type: string
    category: string,
}

export default function UserAidInformationCard({data, status}: IUserAidInformationCard) {
    const {mutate, status: savingStatus} = useMutation({mutationKey: ["saveUserAid"], mutationFn: saveUserAid})
    const {register, watch, setValue, handleSubmit} = useForm<Inputs>()
    const watchType = watch("type")
    let formattedStatus = "brak"

    const submitHandler = (formData: Inputs) => {
        mutate({
            aid_type_id: parseInt(formData.type),
            aid_category_id: parseInt(formData.category)
        })
    }

    if (status === "pending") {
        return (
            <Card>
                <CardHeader>
                    <CardTitle>Formy pomocy</CardTitle>
                    <CardDescription>Tutaj znajdują się twoje wybrane/preferowane formy pomocy</CardDescription>
                </CardHeader>
                <CardContent>
                    <CircleSpinner/>
                </CardContent>
            </Card>
        )
    }

    if (status === "error") {
        return (
            <Card>
                <CardHeader>
                    <CardTitle>Formy pomocy</CardTitle>
                    <CardDescription>Tutaj znajdują się twoje wybrane/preferowane formy pomocy</CardDescription>
                </CardHeader>
                <CardContent>
                    <p className="text-red-600 font-semibold">Nie udało się pobrać rodzai pomocy</p>
                </CardContent>
            </Card>
        )
    }

    switch (savingStatus) {
        case "pending":
            formattedStatus = "Zapisywanie..."
            break
        case "error":
            formattedStatus = "Błąd"
            break
        case "success":
            formattedStatus = "Zapisano"
            break
    }

    return (
        <Card>
            <CardHeader>
                <CardTitle>Forma pomocy</CardTitle>
                <CardDescription>Tutaj znajduję się twoja wybrana/preferowana forma pomocy</CardDescription>
            </CardHeader>
            <CardContent>
                <form className="flex flex-col gap-6" onSubmit={handleSubmit(submitHandler)}>
                    <Select
                        onValueChange={(value) => setValue("type", value)}
                        {...register("type", {required: "Musisz wybrać typ pomocy"})}>
                        <SelectTrigger>
                            <SelectValue placeholder="typ pomocy (zdalna lub osobista)"/>
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem value="1">Zdalna</SelectItem>
                            <SelectItem value="2">Osobista</SelectItem>
                        </SelectContent>
                    </Select>
                    <Select
                        disabled={!watchType}
                        onValueChange={(value) => setValue("category", value)}
                        {...register("category", {required: "Musisz wybrać kategorię pomocy"})}>
                        <SelectTrigger>
                            <SelectValue placeholder="kategoria pomocy"/>
                        </SelectTrigger>
                        <SelectContent>
                            {data!.data.data.map((category) => {
                                if ((watchType === "1" && category.aid_type === "zdalna") || (watchType === "2" && category.aid_type === "osobista")) {
                                    return (
                                        <SelectItem value={category.id.toString()}
                                                    key={category.id}>{category.name}</SelectItem>
                                    )
                                }
                            })}
                        </SelectContent>
                    </Select>
                    <div className="flex justify-between items-center">
                        <Button disabled={savingStatus === "pending"}
                                className="bg-green-600 hover:bg-green-700 font-semibold w-fit px-6">
                            {savingStatus === "pending" ? <CircleSpinner/> : "Zapisz"}
                        </Button>
                        <p>Status: {formattedStatus}</p>
                    </div>
                </form>
            </CardContent>
        </Card>
    )
}