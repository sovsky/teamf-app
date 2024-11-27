import * as React from "react"
import {MdAdminPanelSettings} from "react-icons/md";
import {SidebarItem} from "@/components/NavigationSidebar.Item"
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from "@/components/ui/sidebar"


export function NavigationSidebar({items}: React.ComponentProps<typeof Sidebar>) {
    return (
        <Sidebar variant="inset">
            <SidebarHeader className="bg-gray-800 rounded-t-lg">
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <a href="#">
                                <div className="flex aspect-square size-8
                items-center justify-center rounded-lg bg-teal-600 text-emerald-50">

                                    <MdAdminPanelSettings/>
                                </div>
                                <div className="grid flex-1 text-left text-sm leading-tight">
                                    <span className="truncate font-semibold text-neutral-50">SWP</span>
                                    <span className="truncate text-xs text-emerald-600">Admin</span>
                                </div>
                            </a>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>
            <SidebarContent className="flex flex-col justify-between bg-gray-800 ">
                <SidebarItem items={items.navMain} label={items.navMain.label} cn="text-neutral-300 "/>
                <SidebarItem items={items.navFooter}/>

            </SidebarContent>
            <SidebarFooter className="bg-gray-800 rounded-b-lg">


            </SidebarFooter>
        </Sidebar>
    )
}
