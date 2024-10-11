import React from 'react'
import { Outlet } from 'react-router-dom'

const RootLayout:React.FC = () => {
  return (
    <div>
      <div>Navbar</div>
      <div>
        <Outlet/>
      </div>
    </div>
  )
}

export default RootLayout;