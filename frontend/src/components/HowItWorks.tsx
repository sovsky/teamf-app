import React from 'react'
import HowItWorksItem from './HowItWorksItem'
import { MdVolunteerActivism } from "react-icons/md";
import { FaPeopleRoof } from "react-icons/fa6";
import { FaHandsHelping } from "react-icons/fa";
import { Button } from './ui/button';
import { itemsNeedy, itemsVolunteer } from '@/constants';
import {Link} from "react-router-dom";


const HowItWorks: React.FC = () => {
    return (
        <div className='py-16  rounded-3xl' id="how_it_works">
            <div className='text-4xl flex items-center gap-0.5 justify-center font-bold mb-20'>
                <FaHandsHelping/>
                Jak to działa
            </div>
            <div className='grid grid-cols-1 md:grid-cols-2 gap-11 px-7 max-w-[1540px] mx-auto '>
                {/* Kolumna dla wolontariusza */}
                <div className='bg-neutral-50 py-10 pl-3 pr-8 rounded-xl shadow'>


const HowItWorks:React.FC = () => {
  return (
    <div className='py-16  rounded-3xl' id="how_it_works">
      <div className='text-4xl flex items-center gap-0.5 justify-center font-semibold mb-20'>
        <FaHandsHelping/>
        Jak to działa</div>
      <div className='grid grid-cols-1 md:grid-cols-2 gap-11 px-7 max-w-[1540px] mx-auto '>
        {/* Kolumna dla wolontariusza */}
        <div className='bg-neutral-50 py-10 pl-3 pr-8 rounded-xl shadow'>
        
          <div className='text-2xl font-semibold mb-20 flex items-center gap-6 justify-center'>
          <MdVolunteerActivism className='w-12 h-12'/>
            Wolontariusz</div>
    
   {itemsVolunteer?.map((item,index)=>{
    return(
      <HowItWorksItem 
      item={item} 
      key={index} 
      role="volunteer"/>
    )
   })}
   <div className='flex justify-center'>
    <Link to="/register?role=volunteer">
                            <Button className='py-6'>Załóż konto</Button>
                        </Link>
   </div>
        </div>

        {/* Kolumna dla osoby potrzebującej */}
        <div className='bg-neutral-50 py-10 pl-3 pr-8  rounded-xl shadow'>
        <div className='text-2xl font-semibold mb-20 flex items-center gap-6 justify-center'>
          <FaPeopleRoof className='w-12 h-12'/>
            Osoba potrzebująca</div>
          {itemsNeedy?.map((item,index)=>{
    return(
      <HowItWorksItem 
      item={item} 
      key={index} />
    )
   })}
    <div className='flex justify-center'>
    <Link to="/register?role=inNeed">
                            <Button className='py-6'>Załóż konto</Button>
                        </Link>
   </div>
        </div>
    )
}

export default HowItWorks
