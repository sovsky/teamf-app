import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {IMatchingUser} from "@/lib/api/getMatchingUsers.ts";

interface IMAtchedUserCard {
    user: IMatchingUser
}

export default function MatchedUserCard({user}: IMAtchedUserCard) {
    return (
        <Card className="bg-violet-600 text-white shadow-md">
            <CardHeader>
                <CardTitle>Użytkownik o nazwie: {user.name}</CardTitle>
            </CardHeader>
            <CardContent>
                <p>Miejscowość: {user.city}</p>
                <p>Forma pomocy: {user.latest_selection.aid_type} / {user.latest_selection.aid_category}</p>
            </CardContent>
        </Card>
    )
}