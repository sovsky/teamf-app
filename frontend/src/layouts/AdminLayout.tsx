import { AppSidebar } from "@/components/AppSidebar"
import { NavUser } from "@/components/NavUser"
import {
  Breadcrumb,
  BreadcrumbItem,
  BreadcrumbLink,
  BreadcrumbList,
  BreadcrumbPage,
  BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { Separator } from "@/components/ui/separator"
import {
  SidebarInset,
  SidebarProvider,
  SidebarTrigger,
} from "@/components/ui/sidebar"
import { adminNavbarOptions } from "@/constants"
import { Link, Outlet, useLocation } from "react-router-dom"

export default function AdminLayout() {
  const {pathname} =useLocation();
  const pathSegments = pathname.replace(/^\/admin/, "").split("/").filter(Boolean);
  console.log(pathname)
  return (

<SidebarProvider >
      <AppSidebar />
      <SidebarInset className="">
        <header className="flex h-16 shrink-0  items-center gap-2 justify-between">
 
          <div className="flex items-center gap-2 px-4">
            <SidebarTrigger className="-ml-1" />
            <Separator orientation="vertical" className="mr-2 h-4" />
            <Breadcrumb>
              <BreadcrumbList>
                <BreadcrumbItem className="hidden md:block">
                  <BreadcrumbLink >
                  <Link to="/admin">  Admin</Link>
                  </BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator className="hidden md:block" />
                <BreadcrumbItem>
                  <BreadcrumbPage>
                  {pathSegments.map((segment, index) => {
                  // Construct the path up to the current segment
                  const to = `/admin/${pathSegments.slice(0, index + 1).join("/")}`;

                  return (
                  
         
                
                       <BreadcrumbItem>
                        <BreadcrumbLink>
                          <Link to={to}>
                            {/* Capitalize and show segment */}
                            {segment.charAt(0).toUpperCase() + segment.slice(1)}
                          </Link>
                        </BreadcrumbLink>
                      </BreadcrumbItem>
                      
           
               
                  );
                })}
                  </BreadcrumbPage>
                </BreadcrumbItem>
              </BreadcrumbList>
            </Breadcrumb>
          </div>
         <div>
         <NavUser user={adminNavbarOptions.user} />
         </div>
        </header>

<Outlet/>

      </SidebarInset>
    </SidebarProvider>

  )
}
