import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";
import {Button} from "@/components/ui/button.tsx";
import {Label} from "@/components/ui/label.tsx";
import {Input} from "@/components/ui/input.tsx";

export default function Login() {

    return (
        <main className="h-screen flex justify-center items-center bg-teal-50 p-5">
            <Card className="sm:px-10 sm:py-5 min-w-[300px]">
                <CardHeader>
                    <Link className="text-blue-400 font-semibold py-2" to="/">Powrót</Link>
                    <CardTitle className="text-2xl font-bold">Witaj z powrotem!</CardTitle>
                </CardHeader>
                <CardContent>
                    <form className="flex flex-col gap-6">
                        <div className="grid w-full max-w-sm items-center gap-1.5">
                            <Label htmlFor="email">Email</Label>
                            <Input id="email" type="email"/>
                        </div>
                        <div className="grid w-full max-w-sm items-center gap-1.5">
                            <Label htmlFor="password">Hasło</Label>
                            <Input id="password" type="password"/>
                        </div>
                        <Button type="submit" className="bg-teal-500 hover:bg-teal-600 text-white">Zaloguj</Button>
                    </form>
                </CardContent>
            </Card>
        </main>
    )
}
