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
import { adminNavbarOptions, breadcrumbTranslations } from "@/constants"
import { Link, Outlet, useLocation } from "react-router-dom";
import { Toaster } from "@/components/ui/toaster"
import useAuth from "@/hooks/useAuth"

const AdminLayout:React.FC = () => {
  const {pathname} =useLocation();
  const pathSegments = pathname.replace(/^\/admin/, "").split("/").filter(Boolean);
  const {user} = useAuth()

  return (

<SidebarProvider >
      <AppSidebar />
      <SidebarInset className="bg-zinc-100">
        <header className="flex h-16 shrink-0  items-center gap-2 justify-between">
 
          <div className="flex items-center gap-2 px-4">
            <SidebarTrigger className="-ml-1" />
            <Separator orientation="vertical" className="mr-2 h-4" />
            <Breadcrumb>
              <BreadcrumbList>
                <BreadcrumbItem className="hidden md:block">
                  <BreadcrumbLink >
                  <Link to="/admin">Pulpit</Link>
                  </BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator className="hidden md:block" />
                <BreadcrumbItem>
                  <BreadcrumbPage>
                  {pathSegments.map((segment, index) => {
                  // Construct the path up to the current segment
                  const to = `/admin/${pathSegments.slice(0, index + 1).join("/")}`;
                  const translatedSegment = breadcrumbTranslations[segment] || segment; // Użyj tłumaczenia lub oryginalnej nazwy
                  return (
                  
         
                
                       <BreadcrumbItem>
                        <BreadcrumbLink>
                          <Link to={to}>
                            {/* Capitalize and show segment */}
                            {translatedSegment.charAt(0).toUpperCase() + translatedSegment.slice(1)}
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
         <NavUser user={user} />
         </div>
        </header>

<Outlet/>

      </SidebarInset>
      <Toaster/>
    </SidebarProvider>

  )
}
export default  AdminLayout;