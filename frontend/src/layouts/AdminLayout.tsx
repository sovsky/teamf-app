import { AppSidebar, NavigationSidebar } from "@/components/NavigationSidebar"
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

  const location = useLocation();
  const pathnames = location.pathname.split("/").filter((x) => x); // Split pathname and remove empty elements
  function capitalizeFirstLetter(string: string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  return (
    <SidebarProvider>
    <NavigationSidebar items={adminNavbarOptions} />
    <SidebarInset>
      <header className="flex h-16 shrink-0 items-center gap-2">
        <div className="flex items-center gap-2 px-4">
          <SidebarTrigger className="-ml-1" />
          <Separator orientation="vertical" className="mr-2 h-4" />
          <Breadcrumb>
            <BreadcrumbList>
              <BreadcrumbItem>
                <BreadcrumbLink as={Link} to="/"> {/* Home link */}
               
                </BreadcrumbLink>
              </BreadcrumbItem>
              {pathnames.map((value, index) => {
                const to = `/${pathnames.slice(0, index + 1).join("/")}`;
                const isLast = index === pathnames.length - 1;

                return (
                  <div key={to} className="flex items-center">
                    <BreadcrumbSeparator />
                    <BreadcrumbItem>
                      {isLast ? (
                        <BreadcrumbPage>{capitalizeFirstLetter(value)}</BreadcrumbPage>
                      ) : (
                        <BreadcrumbLink >
                        <Link  to={to}>  {capitalizeFirstLetter(value)}</Link>
                        
                        </BreadcrumbLink>
                      )}
                    </BreadcrumbItem>
                  </div>
                );
              })}
            </BreadcrumbList>
          </Breadcrumb>
        </div>
      </header>
      <div className="flex flex-1 flex-col gap-4 p-4 pt-0">
        <Outlet />
      </div>
    </SidebarInset>
  </SidebarProvider>
  )
}
