import React from 'react'
import { Outlet } from 'react-router-dom'
import Navbar from '../components/Navbar'

const RootLayout:React.FC = () => {
  return (
    <div className='flex flex-col'>
     <Navbar/>
      <div>
        <Outlet/>
      </div>
    </div>
  )
}

export default RootLayout;