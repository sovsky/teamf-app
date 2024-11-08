import * as React from "react"
import {Command} from "lucide-react"

import { NavMain } from "@/components/nav-main"
import { NavSecondary } from "@/components/nav-secondary"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuItem,
} from "@/components/ui/sidebar"
import { adminNavbarOptions } from "@/constants"


export function AppSidebar({ ...props }: React.ComponentProps<typeof Sidebar>) {
  return (
    <Sidebar variant="sidebar" {...props}>
      <SidebarHeader className="bg-gray-800 text-gray-200 ">
        <SidebarMenu  >
          <SidebarMenuItem>
         
      <div className="flex space-x-2 py-2 px-1.5">
              
      <div className="flex aspect-square size-8 items-center justify-center rounded-lg bg-teal-700 text-sidebar-primary-foreground">
                  <Command className="size-4 text-green-200" />
                </div>
                <div className="grid flex-1 text-left text-sm leading-tight">
                  <span className="truncate font-semibold text-neutral-300">SąsiadWPotrzebie</span>
                  <span className="truncate text-xs text-emerald-500">Panel Admina</span>
                </div>
             
      </div>
         
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent className="bg-gray-800 text-gray-200 py-2.5 ">
        <NavMain items={adminNavbarOptions.navMain} />
        {/* <NavProjects projects={data.projects} /> */}
      
      </SidebarContent>
      <SidebarFooter className="bg-gray-800 text-gray-200">
      <NavSecondary items={adminNavbarOptions.navFooter} className="mt-auto" />
      </SidebarFooter>
    </Sidebar>
  )
}
