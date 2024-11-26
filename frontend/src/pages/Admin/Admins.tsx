import { Button } from '@/components/ui/button';
import { admins } from '@/constants';

import React from 'react'
import { MdAdminPanelSettings } from "react-icons/md";
import { IoIosMore } from 'react-icons/io';
import { PopupBox } from '@/components/PopupBox';
import usePopup from '@/hooks/usePopup';
import RegisterAdmin from '@/components/forms/registerAdmin/RegisterAdmin';
import { MdAddModerator } from "react-icons/md";
const Admins:React.FC = () => {
    const {openPopup} = usePopup()
    const headerColums = Object.keys(admins[0]).length

  return (
    <div className="flex flex-1 flex-col gap-4 px-11 py-7  ">
<div className='flex items-center justify-between'>
  <h2 className='text-xl font-semibold text-gray-800 flex items-center gap-x-1.5'>
    <MdAdminPanelSettings className='h-6 w-6'/>
    Konta administratorów
    </h2>
  <Button
  onClick={()=>openPopup({headerIcon:<MdAddModerator/>, headerTitle:"Utwórz konto admina", headerDescription:"Wprowadź wymagane dane", children:<RegisterAdmin/>})}
  >Utwórz konto</Button>
  <PopupBox/>
</div>

<div className=' rounded-lg w-full h-full'>
<div className=' rounded-lg w-full h-full p-4 flex flex-col gap-y-3.5 '>
  {/* HEADER */}
<div className='text-xs text-slate-800 font-semibold w flex items-center justify-between px-3.5 py-2 b  '>
{Object.keys(admins[0]).map((key) => {

  return key.charAt(0).toUpperCase() + key.slice(1); // Pozostałe klucze w formie PascalCase
}).filter(Boolean).map((key)=>{
  return(
    <div className={`${key === "Name" ? "'shrink-0 flex-1' ": 'shrink-0 flex-1 flex justify-center'} w-1/${headerColums}`}>{key}</div>
  )
})}
</div>
{/* END OF HEADER */}

{admins.map((admin)=>{
  return(
    <div className='bg-neutral-50 text-gray-800/90 shadow flex items-center justify-between px-7 p-3.5 rounded-lg '>



<div className='shrink-0 flex-1 flex justify-start'>
  <span>{admin.name}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{admin.email}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{admin.age}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{admin.city}</span>
</div>

<div className='w-fit cursor-pointer hover:text-teal-600 '>
  <IoIosMore className='w-6 h-6'/>
</div>
    </div>
  )
})}
</div>
</div>

  </div>
  )
}

export default Admins