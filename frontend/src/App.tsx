import {Routes,Route} from "react-router-dom";
import RootLayout from "./layouts/RootLayout";
import Home from "./pages/Home";


const App =()=> {

  return (
<Routes>
  <Route path="/" element={<RootLayout/>}>
<Route index element={<Home/>}/>
  </Route>

</Routes>
 
 
  )
}

export default App
