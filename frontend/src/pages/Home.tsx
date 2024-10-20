import React from 'react'
import Hero from '../components/Hero'
import Tiles from '@/components/Tiles'

import HowItWorks from '@/components/HowItWorks'
import About from '@/components/About'
import FaqSection from '@/components/FaqSection'
import Footer from '@/components/Footer'

const Home:React.FC = () => {
  return (
    <div className=''>
      <Hero/>
      <div className='max-w-[1580px] mx-auto'>
      <Tiles/>
      <HowItWorks/>
      </div>
      <About/>

      <div className='max-w-[1580px] mx-auto'>
 <FaqSection/>
      </div>
      <Footer/>

    </div>
  )
}

export default Home