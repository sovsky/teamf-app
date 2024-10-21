import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";
import {useState} from "react";
import FirstStepForm from "@/components/forms/register/FirstStepForm.tsx";
import SecondStepForm from "@/components/forms/register/SecondStepForm.tsx";

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

export interface ICity {
    id: number,
    value: string
}

export interface IHelpType {
    id: number,
    value: string,
    label: string,
}

export default function Register() {

    const Cities: ICity[] = [
        {id: 1, value: "Warszawa"},
        {id: 2, value: "Kraków"},
        {id: 3, value: "Wrocław"}
    ]

    const HelpTypes: IHelpType[] = [
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

    const multiForm = [
        {
            title: "Uzupełnij dane 1 / 2",
            form: <FirstStepForm setActualStep={setActualStep} setFullFormData={setFullFormData}
                                 fullFormData={fullFromData}/>,
        },
        {
            title: "Uzupełnij dane 2 / 2",
            form: <SecondStepForm setActualStep={setActualStep} setFullFormData={setFullFormData}
                                  fullFormData={fullFromData} cities={Cities} helpTypes={HelpTypes}/>
        }
    ]

    return (

            <Card className="sm:px-10 sm:py-5 min-w-[300px] w-full max-w-[600px]">
                <CardHeader>
                    <Link className="text-blue-400 font-semibold py-2" to="/">Strona Główna</Link>
                    <CardTitle className="text-2xl font-bold">{multiForm[actualStep - 1].title}</CardTitle>
                </CardHeader>
                <CardContent>
                    {multiForm[actualStep - 1].form}
                </CardContent>
            </Card>
    )
}
