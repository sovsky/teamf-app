import {
    DropdownMenu,
    DropdownMenuContent, DropdownMenuItem, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu.tsx";
import {IAuthData} from "@/context/authContext.tsx";
import useLogout from "@/hooks/useLogout";
import {useNavigate} from "react-router-dom";

interface INavProfile {
    user: IAuthData
}

export default function NavProfile({user}: INavProfile) {
    const navigate = useNavigate();
    const {handleLogout} = useLogout();
    const NavProfileItems = [
        {label: "Moj profil", type: "link", onClick: () => navigate('/profile')},
        {label: "Wyloguj", type: "logout", onClick: () => handleLogout()},
    ]

    return (
        <DropdownMenu>
            <DropdownMenuTrigger
                className="bg-violet-500/90 text-white py-2 px-4 font-bold rounded-lg shadow-sm">{user.email}</DropdownMenuTrigger>
            <DropdownMenuContent>
                {NavProfileItems.map(({label, type, onClick}) => {
                    return (
                        <>
                            <DropdownMenuItem
                                className={`${type === "link" ? "text-slate-800 cursor-pointer hover:bg-blue-100" : "text-rose-700 hover:text-rose-600 cursor-pointer"}`}
                                onClick={onClick}>{label}</DropdownMenuItem>
                            <DropdownMenuSeparator/>
                        </>
                    )
                })}

            </DropdownMenuContent>
        </DropdownMenu>
    )
}
{/* <DropdownMenuItem className="text-red-700 cursor-pointer" onClick={logoutHandler}>Wyloguj</DropdownMenuItem> */
}