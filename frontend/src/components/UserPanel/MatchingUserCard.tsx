import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {AxiosResponse} from "axios";
import {IMatchingResponse} from "@/lib/api/getMatchingUsers.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";

interface IMatchingUserCard {
    data: AxiosResponse<IMatchingResponse, string> | undefined,
    status: "pending" | "error" | "success"
}

export default function MatchingUserCard({data, status}: IMatchingUserCard) {

    if (status === "pending") {
        return (
            <Card className="col-start-1 col-end-3">
                <CardHeader>
                    <CardTitle>Wyszukane dopasowania</CardTitle>
                </CardHeader>
                <CardContent>
                    <CircleSpinner/>
                </CardContent>
            </Card>
        )
    }

    if (status === "error") {
        return (
            <Card className="col-start-1 col-end-3">
                <CardHeader>
                    <CardTitle>Wyszukane dopasowania</CardTitle>
                </CardHeader>
                <CardContent>
                    <p>Błąd przy pobieraniu dopasowań</p>
                </CardContent>
            </Card>
        )
    }

    return (
        <Card className="col-start-1 col-end-3">
            <CardHeader>
                <CardTitle>Wyszukane dopasowania</CardTitle>
            </CardHeader>
            <CardContent>
                {data!.data.data.map((matchedUser) => {
                    console.log(matchedUser)

                    return (
                        <div></div>
                    )
                })}
            </CardContent>
        </Card>
    )
}