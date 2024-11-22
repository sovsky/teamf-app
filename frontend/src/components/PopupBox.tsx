import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import RegisterAdmin from "./forms/registerAdmin/RegisterAdmin"
import useRegister from "@/hooks/useRegister"
import usePopup from "@/hooks/usePopup"

export function PopupBox() {

    const {popup,openPopup, closePopup} = usePopup()

    const {formData, setFormData, submitHandler, status} = useRegister()
  return (
    <Dialog open={popup.isOpen} onOpenChange={(open) => open ? null : closePopup()} >
      {/* <DialogTrigger asChild>
        <Button variant="outline">Edit Profile</Button>
      </DialogTrigger> */}
      <DialogContent className="sm:max-w-[650px]">
        <DialogHeader>
          <DialogTitle className="flex items-center gap-0.5">
            {popup.headerIcon}
            {popup.headerTitle}</DialogTitle>
          <DialogDescription>
         {popup.headerDescription}
          </DialogDescription>
        </DialogHeader>
  <RegisterAdmin setFullFormData={setFormData} fullFormData={formData}/>
        {/* <DialogFooter>
          <Button type="submit">Save changes</Button>
        </DialogFooter> */}
      </DialogContent>
    </Dialog>
  )
}
