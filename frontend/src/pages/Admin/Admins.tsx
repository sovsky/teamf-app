import { Button } from '@/components/ui/button';
import { admins, volunteers } from '@/constants';

import React from 'react'
import { MdAdminPanelSettings, MdVolunteerActivism } from "react-icons/md";
import { IoIosMore } from 'react-icons/io';
import { PopupBox } from '@/components/PopupBox';
import usePopup from '@/hooks/usePopup';
import RegisterAdmin from '@/components/forms/registerAdmin/RegisterAdmin';
import { MdAddModerator } from "react-icons/md";
import { useQuery } from '@tanstack/react-query';
import { getUsersByRole } from '@/lib/api/getUsersByRole';
import { IoCheckmarkCircle } from 'react-icons/io5';
import { FaCircleXmark } from 'react-icons/fa6';
import { calculateAge } from '@/lib/utils';
const Admins:React.FC = () => {
    const {openPopup} = usePopup()
    const headerColums = Object.keys(admins[0]).length

    const {data:users} =useQuery({
      queryKey:["admins"],
      queryFn:()=>{
        return getUsersByRole({role:"admin"})
      }
    })
    




    return (
    <div className="flex flex-1 flex-col gap-4 px-10 py-5  ">
<div className='flex items-center justify-between'>
  <h2 className='text-xl font-semibold flex items-center gap-x-1.5'>
    <MdAddModerator className='h-6 w-6'/>
    Administratorzy
    </h2>
  <Button>Dodaj</Button>
</div>

<div className=' rounded-lg w-full h-full p-4 flex flex-col gap-y-3.5 '>
  {/* HEADER */}
<div className='text-xs text-slate-800 font-semibold w flex items-center justify-between px-3.5 py-2 b  '>
{Object.keys(volunteers[0]).map((key) => {

  return key.charAt(0).toUpperCase() + key.slice(1); // Pozostałe klucze w formie PascalCase
}).filter(Boolean).map((key)=>{
  return(
    <div className={key === "Imię" ? "'shrink-0 flex-1' w-1/5 ": 'shrink-0 flex-1 flex justify-center'}>{key}</div>
  )
})}
</div>
{/* END OF HEADER */}

{users?.users?.map((volunteer)=>{
  return(
    <div className='bg-neutral-50 text-gray-800/90 shadow flex items-center justify-between px-7 p-3.5 rounded-lg '>

   <div className='flex flex-col shrink-0 w-1/5'>
   <span>{volunteer?.name}</span>
   {/* <span>{volunteer.lastName}</span> */}
   </div>

   <div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer?.email_verified_at ? <IoCheckmarkCircle className='text-green-400'/>:<FaCircleXmark className='text-rose-400'/>}</span>

</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer?.email}</span>
</div>



<div className='shrink-0 flex-1 flex justify-center'>
<span>{calculateAge(volunteer.age)}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer.city_id}</span>
</div>
<div className='w-fit cursor-pointer hover:text-teal-600'>
  <IoIosMore className='w-6 h-6'/>
</div>
    </div>
  )
})}
</div>

  </div>
  )



}

export default Admins