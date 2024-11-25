import {
    DropdownMenu,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu.tsx";



export default function NavProfileSkeleton() {

    return (
        <DropdownMenu>
            <DropdownMenuTrigger
                className="bg-slate-400/90 text-white py-2 px-4 font-bold rounded-lg shadow-sm text-slate-400/90 ">Zordon@wp.pl</DropdownMenuTrigger>

        </DropdownMenu>
    )
}
