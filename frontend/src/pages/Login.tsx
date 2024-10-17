import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";
import LoginForm from "@/components/forms/login/loginForm.tsx";

export default function Login() {

    return (
        <main className="h-screen flex justify-center items-center bg-violet-50 p-5">
            <Card className="sm:px-10 sm:py-5 min-w-[300px] w-full max-w-[600px]">
                <CardHeader>
                    <Link className="text-blue-400 font-semibold py-2" to="/">Strona Główna</Link>
                    <CardTitle className="text-2xl font-bold">Witaj z powrotem</CardTitle>
                </CardHeader>
                <CardContent>
                    <LoginForm/>
                </CardContent>
            </Card>
        </main>
    )
}
