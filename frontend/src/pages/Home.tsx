import React from 'react'
import Hero from '../components/Hero'
import Tiles from '@/components/Tiles'

import HowItWorks from '@/components/HowItWorks'

const Home:React.FC = () => {
  return (
    <div className=''>
      <Hero/>
      <div className='max-w-[1580px] mx-auto'>
      <Tiles/>
      <HowItWorks/>
      </div>

    </div>
  )
}

export default Home