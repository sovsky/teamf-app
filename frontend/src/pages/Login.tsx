import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";
import LoginForm from "@/components/forms/login/loginForm.tsx";
import {motion} from "framer-motion";

export default function Login() {

    const MotionCard = motion.create(Card)

    return (
        <MotionCard initial={{opacity: 0, translateY: -50}}
                    animate={{opacity: 1, translateY: 0, transition: {duration: 0.5}}}
                    className="sm:px-10 sm:py-5 min-w-[300px] w-full max-w-[600px]">
            <CardHeader>
                <Link className="text-blue-400 font-semibold py-2" to="/">Strona Główna</Link>
                <CardTitle className="text-2xl font-bold">Witaj z powrotem</CardTitle>
            </CardHeader>
            <CardContent>
                <LoginForm/>
            </CardContent>
        </MotionCard>
    )
}
