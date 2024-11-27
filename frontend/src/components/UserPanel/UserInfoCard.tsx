import {Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {IAuthData} from "@/context/authContext.tsx";
import {Button} from "@/components/ui/button.tsx";
import useLogout from "@/hooks/useLogout.ts";

interface IUserInfoCard {
    user: IAuthData,
}

export default function UserInfoCard({user}: IUserInfoCard) {
    const {handleLogout, status} = useLogout()
    const disabled = status === "pending"

    return (
        <Card>
            <CardHeader>
                <CardTitle>Profil</CardTitle>
                <CardDescription>Podstawowe informacje o twoim profilu.</CardDescription>
            </CardHeader>
            <CardContent>
                <p>Nazwa: {user.name}</p>
                <p>Email: {user.email}</p>
                <p>Rola: {user.role === "deprived person" ? "osoba potrzebująca" : "wolontariusz"}</p>
            </CardContent>
            <CardFooter className="flex justify-end">
                <Button disabled={disabled} onClick={() => handleLogout()}
                        className="bg-red-600 hover:bg-red-700 font-semibold">Wyloguj</Button>
            </CardFooter>
        </Card>
    )
}