import * as React from "react"
import {
  BookOpen,
  Bot,

  Frame,
  LifeBuoy,
  Map,
  PieChart,
  Send,
  Settings2,
  SquareTerminal,
} from "lucide-react"
import { IoPeople } from "react-icons/io5";
import { MdAdminPanelSettings } from "react-icons/md";
import { PiUsers } from "react-icons/pi";
import { NavMain, SidebarItem } from "@/components/NavigationSidebar.Item"
import { NavProjects } from "@/components/nav-projects"
import { NavSecondary } from "@/components/nav-secondary"
import { LuHelpingHand } from "react-icons/lu";
import { NavUser } from "@/components/NavigationSidebar.User"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from "@/components/ui/sidebar"
import { adminNavbarOptions } from "@/constants";



export function NavigationSidebar({items}: React.ComponentProps<typeof Sidebar>) {
  return (
    <Sidebar variant="inset" >
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton size="lg" asChild>
              <a href="#">
                <div className="flex aspect-square size-8 items-center justify-center rounded-lg bg-sidebar-primary text-sidebar-primary-foreground">
                  
               <MdAdminPanelSettings/>
                </div>
                <div className="grid flex-1 text-left text-sm leading-tight">
                  <span className="truncate font-semibold text-purple-700/90">SWP</span>
                  <span className="truncate text-xs">Admin</span>
                </div>
              </a>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent className="flex flex-col justify-between">
        <SidebarItem items={items.navMain} label={items.navMain.label} />
        <SidebarItem items={items.navFooter}  />

      </SidebarContent>
      <SidebarFooter>
       
        <NavUser user={items.user} />
      </SidebarFooter>
    </Sidebar>
  )
}
