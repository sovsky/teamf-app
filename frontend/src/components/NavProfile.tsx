import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuItem,
    DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu.tsx";
import {IAuthData} from "@/context/authContext.tsx";

interface INavProfile {
    user: IAuthData
    logoutHandler: () => void
}

export default function NavProfile({user, logoutHandler}: INavProfile) {

    return (
        <DropdownMenu>
            <DropdownMenuTrigger
                className="bg-violet-500 text-white py-2 px-4 font-bold rounded-lg shadow-sm">{user.email}</DropdownMenuTrigger>
            <DropdownMenuContent>
                <DropdownMenuLabel>Mój Profil</DropdownMenuLabel>
                <DropdownMenuSeparator/>
                <DropdownMenuItem className="text-red-700 cursor-pointer" onClick={logoutHandler}>Wyloguj</DropdownMenuItem>
            </DropdownMenuContent>
        </DropdownMenu>
    )
}
