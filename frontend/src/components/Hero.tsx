import { Button } from "./ui/button";


const  Hero = ()=> {
  return (
    <>
      {/* Hero */}
      <div className=" overflow-hidden relative  grid grid-cols-1 2xl:grid-cols-[4fr_5fr] xl:grid-cols-[2fr_3fr] 
      rounded-3xl max-w-[96%] mx-auto bg-gradient-to-r from-purple-100 via-blue-100 to-blue-100   justify-between 2xl:mx-auto   xl:h-[630px]  2xl:px-0"
      >
        {/* End Gradients */}
  
          <div className="container py-10 lg:py-24 mx-auto  ">
            <div className="xl:max-w-2xl text-center  xl:ml-20 2xl:ml-52 flex flex-col gap-2 w-full ">
         
              {/* Title */}
              <div className="mt-5 max-w-2xl mx-auto">
                <h1 className="text-blue-950 scroll-m-20 text-6xl font-bold tracking-tight lg:text-6xl">
                Razem dla lepszego jutra
                </h1>
              </div>
              {/* End Title */}
              <div className="mt-8 max-w-3xl mx-auto px-6 sm:px-20 lg:px-0 ">
                <p className="text-3xl text-muted-foreground text-gray-700">
                Łączymy wolontariuszy z potrzebującymi
                Dołącz do nas, aby wprowadzać zmiany w swojej społeczności.
                </p>
              </div>
              {/* Buttons */}
              <div className="mt-12 gap-3 flex justify-center">
                <Button size="lg" className="bg-button_primary py-7 hover:shadow-2xl rounded-2xl hover:bg-button_primary border border-transparent"  >Dołącz teraz</Button>
                <Button  variant="transparent" className="text-gray-600  py-7 border hover:border-2 hover:text-slate-700" size="lg" >
                 Zobacz Więcej
                </Button>
              </div>
              {/* End Buttons */}
            </div>
          </div>
       
<div className=" hidden xl:flex justify-start  ">
<img src="../../public/hero3.png" className="w-fit h-[660px] absolute top-12 " alt="" />
</div>      
      </div>
      {/* End Hero */}
    </>
  );
}

export default Hero;
