import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {AxiosResponse} from "axios";
import {IMatchingResponse} from "@/lib/api/getMatchingUsers.ts";
import CircleSpinner from "@/components/CircleSpinner.tsx";
import MatchedUserCard from "@/components/UserPanel/MatchedUserCard.tsx";

interface IMatchingUserCard {
    data: AxiosResponse<IMatchingResponse, string> | undefined,
    status: "pending" | "error" | "success"
}

export default function MatchingUserCard({data, status}: IMatchingUserCard) {

    const matchingHeader = (
        <CardHeader>
            <CardTitle>Wyszukiwarka dopasowań</CardTitle>
            <CardDescription>Tutaj znajdują się dopasowani użytkownicy do twojego profilu</CardDescription>
        </CardHeader>
    )

    if (status === "pending") {
        return (
            <Card className="col-start-1 col-end-3">
                {matchingHeader}
                <CardContent>
                    <CircleSpinner/>
                </CardContent>
            </Card>
        )
    }

    if (status === "error") {
        return (
            <Card className="col-start-1 col-end-3">
                {matchingHeader}
                <CardContent>
                    <p className="text-red-600 font-semibold">Błąd przy pobieraniu dopasowań</p>
                </CardContent>
            </Card>
        )
    }

    return (
        <Card className="col-start-1 col-end-3">
            {matchingHeader}
            <CardContent>
                {data!.data.data.map((matchedUser) => {
                    return (
                        <MatchedUserCard user={matchedUser} key={matchedUser.id}/>
                    )
                })}
            </CardContent>
        </Card>
    )
}