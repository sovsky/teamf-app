import { Button } from "./ui/button";
import { images } from "@/constants";

const  Hero = ()=> {
  return (
    <>
      {/* Hero */}
      <div className=" overflow-hidden relative  rounded-3xl max-w-[96%] bg-gradient-to-r from-purple-100 via-blue-100 to-blue-100   py-24 justify-between mx-auto flex  h-[630px] px-12 2xl:px-0"
      // style={{
      //   backgroundImage: `url(${images.hero7})`,
      //   backgroundPosition: 'center',
      //   backgroundRepeat: 'no-repeat',
      //   backgroundSize: 'cover',
      // }}
      >
{/* <div className="w-full h-full absolute md:rounded-3xl left-0 top-0 opacity-20 bg-slate-900 z-10 pointer-events-none" /> */}
        {/* Gradients */}
        {/* <img src="../../public/wolontariat.jpg" alt="" /> */}

        {/* End Gradients */}
  
          <div className="container py-10 lg:py-16">
            <div className="max-w-2xl text-center ml-52 flex flex-col gap-2">
         
              {/* Title */}
              <div className="mt-5 max-w-2xl">
                <h1 className="text-gray-900 scroll-m-20 text-4xl font-bold tracking-tight lg:text-6xl">
                Razem dla lepszego jutra
                </h1>
              </div>
              {/* End Title */}
              <div className="mt-8 max-w-3xl">
                <p className="text-2xl text-muted-foreground text-gray-700">
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
       



        {/* <div className="w-[66%]  mr-[230px]  rounded-full bg-teal-200 opacity-50    mt-12  min-h-full"></div> */}

        <img src="../../public/hero3.png" className="w-fit h-[660px] absolute top-12 right-[200px]" alt="" />
       

      </div>
      {/* End Hero */}
    </>
  );
}

export default Hero;
// className=" border border-slate-900 px-7 py-3 rounded-md bg-teal-400 font-semibold text-gray-900"

// className="border border-neutral-300 px-4 py-3 rounded-md text-neutral-50"