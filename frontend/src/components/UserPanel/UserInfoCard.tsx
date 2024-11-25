import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card.tsx";

export default function UserInfoCard() {

    return (
        <Card>
            <CardHeader>
                <CardTitle>Twój profil</CardTitle>
                <CardDescription>Podstawowe informacje o twoim profilu.</CardDescription>
            </CardHeader>
            <CardContent>
                <p>Nazwa: Jakub Grzybek</p>
                <p>email: kubagrzybek23@gmail.com</p>
                <p>rola: wolontariusz</p>
            </CardContent>
        </Card>
    )
}