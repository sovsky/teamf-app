import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card.tsx";
import {Link} from "react-router-dom";
import {Input} from "@/components/ui/input.tsx";
import {Label} from "@/components/ui/label.tsx";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select.tsx";
import {Tabs, TabsList, TabsTrigger} from "@/components/ui/tabs.tsx";
import {Button} from "@/components/ui/button.tsx";
import {MultiSelect} from "@/components/ui/multi-select.tsx";

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

    return (
        <main className="h-screen flex justify-center items-center bg-teal-50 p-5">
            <Card className="sm:px-10 sm:py-5 min-w-[300px]">
                <CardHeader>
                    <Link className="text-blue-400 font-semibold py-2" to="/">Powrót</Link>
                    <CardTitle className="text-2xl font-bold">Utwórz Konto</CardTitle>
                </CardHeader>
                <CardContent>
                    <form className="flex flex-col gap-6">
                        <Tabs defaultValue="needer" className="py-2">
                            <TabsList className="grid w-full grid-cols-2">
                                <TabsTrigger className="data-[state=active]:bg-teal-300"
                                             value="needer">Potrzebujący</TabsTrigger>
                                <TabsTrigger className="data-[state=active]:bg-teal-300"
                                             value="helper">Wolontariusz</TabsTrigger>
                            </TabsList>
                        </Tabs>
                        <div className="grid sm:grid-flow-col gap-6">
                            <div className="grid w-full max-w-sm items-center gap-1.5">
                                <Label htmlFor="fullname">Imię</Label>
                                <Input id="fullname"/>
                            </div>
                            <div className="grid w-full max-w-sm items-center gap-1.5">
                                <Label htmlFor="email">Email</Label>
                                <Input id="email" type="email"/>
                            </div>
                        </div>
                        <div className="grid sm:grid-flow-col gap-6">
                            <div className="grid w-full items-center gap-1.5">
                                <Label htmlFor="password">Hasło</Label>
                                <Input id="password" type="password"/>
                            </div>
                        </div>
                        <div className="grid sm:grid-flow-col gap-6">
                            <div className="grid w-full max-w-sm items-center gap-1.5">
                                <Label htmlFor="age">Wiek</Label>
                                <Input id="age" type="number" min="0" max="999"/>
                            </div>
                            <div className="grid w-full max-w-sm items-center gap-1.5">
                                <Label htmlFor="phone">Numer Telefonu</Label>
                                <Input id="phone" type="tel"/>
                            </div>
                        </div>
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
                        <Button type="submit" className="bg-teal-500 hover:bg-teal-600 text-white">Zarejestruj</Button>
                    </form>
                </CardContent>
            </Card>
        </main>
    )
}
