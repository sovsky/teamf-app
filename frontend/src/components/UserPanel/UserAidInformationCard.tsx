import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {AxiosResponse} from "axios";
import {IGetAidResponse} from "@/lib/api/getAidCategories.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";
import {useForm} from "react-hook-form";
import {Select, SelectContent, SelectItem, SelectTrigger, SelectValue} from "@/components/ui/select.tsx";
import {Button} from "@/components/ui/button.tsx";

interface IUserAidInformationCard {
    data: AxiosResponse<IGetAidResponse, string> | undefined
    status: "error" | "idle" | "pending" | "success"
}

interface Inputs {
    category: string,
}

export default function UserAidInformationCard({data, status}: IUserAidInformationCard) {
    const {register} = useForm<Inputs>()

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

    return (
        <Card>
            <CardHeader>
                <CardTitle>Formy pomocy</CardTitle>
                <CardDescription>Tutaj znajdują się twoje wybrane/preferowane formy pomocy</CardDescription>
            </CardHeader>
            <CardContent>
                <form className="flex flex-col gap-6">
                    <Select {...register("category", {required: "Musisz wybrać formę pomocy"})}>
                        <SelectTrigger>
                            <SelectValue placeholder="forma pomocy"/>
                        </SelectTrigger>
                        <SelectContent>
                            {data!.data.data.map((category) => {
                                return (
                                    <SelectItem value={category.name} key={category.id}>{category.name}</SelectItem>
                                )
                            })}
                        </SelectContent>
                    </Select>
                    <Button className="bg-green-600 hover:bg-green-700 font-semibold">Zapisz</Button>
                </form>
            </CardContent>
        </Card>
    )
}