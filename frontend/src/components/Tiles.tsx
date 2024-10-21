import React from 'react';
import { GiPoland } from "react-icons/gi";
import { PiCityFill } from "react-icons/pi";
import { MdVolunteerActivism } from "react-icons/md";
import { FaPeopleRoof } from "react-icons/fa6";
const Tiles:React.FC = () => {
  return (
    <div className='py-16 '>

        <div className=' max-w-[90%] lg:max-w-[50%] xl:max-w-[75%] mx-auto grid xl:grid-cols-4 md:grid-cols-2 gap-10 justify-items-center  '>
        <div className='shadow px-6 py-14 flex flex-col items-center rounded-3xl bg-neutral-50 w-full md:w-60 h-48 justify-center gap-4'>
            <GiPoland className='h-8 w-8'/>
            <span className='text-xl font-semibold text-gray-700'>16 Województw</span>
            </div>
  
            <div className='shadow px-6 py-14 flex flex-col items-center rounded-3xl bg-neutral-50 w-full md:w-60  h-48 justify-center gap-4'>
            <PiCityFill className='h-8 w-8'/>
            <span className='text-xl font-semibold text-gray-700'>152 Miasta</span>
            </div>


            <div className='shadow px-6 py-14 flex flex-col items-center rounded-3xl bg-neutral-50 w-full md:w-60  h-48 justify-center gap-4'>
            <MdVolunteerActivism className='h-8 w-8'/>
            <span className='text-xl font-semibold text-gray-700'>120 Wolonatiuszy</span>
            </div>


            <div className='shadow px-6 py-14 flex flex-col items-center rounded-3xl bg-neutral-50 w-full md:w-60  h-48 justify-center gap-4'>
            <FaPeopleRoof className='h-8 w-8'/>
            <span className='text-xl font-semibold text-gray-700'>252 Potrzebujących</span>
            </div>

        </div>
    </div>
  )
}

export default Tiles