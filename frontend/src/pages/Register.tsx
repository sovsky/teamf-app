import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";

import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select.tsx";
import {Button} from "@/components/ui/button.tsx";
import {MultiSelect} from "@/components/ui/multi-select.tsx";
import {useState} from "react";
import FirstStepForm from "@/components/register/FirstStepForm.tsx";

export interface IRegisterForm {
    accountType: "inNeed" | "helper";
    name: string;
    email: string;
    password: string;
    age: number;
    phone: string;
    city: string;
    helpTypes: string[];
}

export default function Register() {

    const Cities = [
        {id: 1, value: "Warszawa"},
        {id: 2, value: "Kraków"},
        {id: 3, value: "Wrocław"}
    ]

    const HelpTypes = [
        {id: 1, value: "food", label: "Żywność"},
        {id: 2, value: "clean products", label: "Środki czystości"},
        {id: 3, value: "clothes", label: "Odzież"},
        {id: 4, value: "psychological", label: "Psychologiczna"},
        {id: 5, value: "medical", label: "Medyczna"}
    ]

    const [actualStep, setActualStep] = useState(1)
    const [fullFromData, setFullFormData] = useState<IRegisterForm>({
        accountType: "inNeed",
        name: "",
        email: "",
        password: "",
        age: 0,
        phone: "",
        city: "",
        helpTypes: []
    })

    const SecondForm = (
        <form className="flex flex-col gap-6">
            <Select>
                <SelectTrigger>
                    <SelectValue className="placeholder:text-muted-foreground"
                                 placeholder="Wybierz miasto"/>
                </SelectTrigger>
                <SelectContent>
                    {Cities.map((city) => {
                        return (
                            <SelectItem key={city.id} value={city.value}>{city.value}</SelectItem>
                        )
                    })}
                </SelectContent>
            </Select>
            <MultiSelect placeholder="Wybierz formy pomocy" options={HelpTypes}
                         onValueChange={() => {
                         }}/>
            <div className="flex gap-2">
                <Button className="border-gray-400 hover:bg-gray-200 bg-white text-gray-600 border-2" onClick={() => {
                    setActualStep(prevState => prevState - 1)
                }}>Cofnij</Button>
                <Button type="submit" className="w-full bg-teal-500 hover:bg-teal-600 text-white">Zarejestruj</Button>
            </div>
        </form>
    )

    const multiForm = [
        {
            title: "Uzupełnij dane 1 / 2",
            form: <FirstStepForm setActualStep={setActualStep} setFullFormData={setFullFormData}
                                 fullFormData={fullFromData}/>,
        },
        {
            title: "Uzupełnij dane 2 / 2",
            form: SecondForm
        }
    ]

    return (
        <main className="h-screen flex justify-center items-center bg-violet-50 p-5">
            <Card className="sm:px-10 sm:py-5 min-w-[300px] w-full max-w-[600px]">
                <CardHeader>
                    <Link className="text-blue-400 font-semibold py-2" to="/">Powrót</Link>
                    <CardTitle className="text-2xl font-bold">{multiForm[actualStep - 1].title}</CardTitle>
                </CardHeader>
                <CardContent>
                    {multiForm[actualStep - 1].form}
                </CardContent>
            </Card>
        </main>
    )
}
