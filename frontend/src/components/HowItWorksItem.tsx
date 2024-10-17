
import React from 'react'
import { FaRegCheckCircle } from 'react-icons/fa';

interface Item{
    title:string;
    description:string;
}

interface IHowItWOrksItemProps{
 item:Item;
 role?:string;
}

const HowItWorksItem:React.FC<IHowItWOrksItemProps> = ({item,role}) => {
    return (
        <div  className='flex mb-12'>
        <div className={`${role === "volunteer"?"text-indigo-500 ":"text-purple-500/90 " }mx-6  h-10 w-10 p-2 justify-center items-center rounded-full`}>
        <FaRegCheckCircle className='w-6 h-6'/>
        </div>
        <div>
            <h5 className='mt-1 mb-2 text-xl'>{item.title}</h5>
            <p className='text-md text-neutral-500'>{item.description}</p>
        </div>
                </div>
      )
}

export default HowItWorksItem