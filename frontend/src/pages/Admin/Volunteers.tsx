import { Button } from '@/components/ui/button'
import { MdVolunteerActivism } from "react-icons/md";
import React from 'react'
import { usersObjectHeaderTranslations, volunteers } from '@/constants';
import { IoIosMore } from "react-icons/io";





const Volunteers:React.FC = () => {
  return (
    <div className="flex flex-1 flex-col gap-4 px-10 py-5  ">
<div className='flex items-center justify-between'>
  <h2 className='text-xl font-semibold flex items-center gap-x-1.5'>
    <MdVolunteerActivism className='h-6 w-6'/>
    Lista Wolontariuszy
    </h2>
  <Button>Dodaj</Button>
</div>

<div className=' rounded-lg w-full h-full p-4 flex flex-col gap-y-3.5 '>
  {/* HEADER */}
<div className='text-xs text-slate-800 font-semibold w flex items-center justify-between px-3.5 py-2 b  '>
{Object.keys(volunteers[0]).map((key) => {
  if (key === "firstName") return "Name"; // Zamiana firstName na Name
  if (key === "lastName") return null;    // Pominięcie lastName w nagłówkach
  return key.charAt(0).toUpperCase() + key.slice(1); // Pozostałe klucze w formie PascalCase
}).filter(Boolean).map((key)=>{
  return(
    <div className={key === "Name" ? "'shrink-0 flex-1' w-1/6": 'shrink-0 flex-1 flex justify-center'}>{usersObjectHeaderTranslations[key] || key}</div>
  )
})}
</div>
{/* END OF HEADER */}

{volunteers.map((volunteer)=>{
  return(
    <div className='bg-neutral-50 text-gray-800/90 shadow flex items-center justify-between px-7 p-3.5 rounded-lg '>

   <div className='flex flex-col shrink-0 w-1/6'>
   <span>{volunteer.firstName+ " "}</span>
   <span>{volunteer.lastName}</span>
   </div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer.nickname}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer.email}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer.age}</span>
</div>

<div className='shrink-0 flex-1 flex justify-center'>
  <span>{volunteer.city}</span>
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

export default Volunteers