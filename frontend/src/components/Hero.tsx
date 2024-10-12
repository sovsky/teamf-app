

const  Hero = ()=> {
  return (
    <>
      {/* Hero */}
      <div className="relative overflow-hidden py-24 lg:py-32 max-w-[98%] md:rounded-3xl mx-auto flex  pt-3 justify-center px-12 2xl:px-0"
           style={{
            backgroundImage: `url(../../public/wolontariat.jpg)`,
            backgroundPosition: 'center',
            backgroundRepeat: 'no-repeat',
            backgroundSize: 'cover',
          }}
      >
        <div className="w-full h-full absolute top-0 left-0 bg-zinc-800 opacity-60"></div>
        {/* Gradients */}
        {/* <img src="../../public/wolontariat.jpg" alt="" /> */}
        <div
          aria-hidden="true"
          className="flex absolute -top-96 start-1/2 transform -translate-x-1/2"
        >
          <div className="bg-gradient-to-r from-background/50 to-background blur-3xl w-[25rem] h-[44rem] rotate-[-60deg] transform -translate-x-[10rem]" />
          <div className="bg-gradient-to-tl blur-3xl w-[90rem] h-[50rem] rounded-full origin-top-left -rotate-12 -translate-x-[15rem] from-primary-foreground via-primary-foreground to-background" />
        </div>
        {/* End Gradients */}
        <div className="relative z-10">
          <div className="container py-10 lg:py-16">
            <div className="max-w-2xl text-center mx-auto">
         
              {/* Title */}
              <div className="mt-5 max-w-2xl">
                <h1 className="text-neutral-200 scroll-m-20 text-4xl font-extrabold tracking-tight lg:text-5xl">
                Razem dla lepszego jutra
                </h1>
              </div>
              {/* End Title */}
              <div className="mt-5 max-w-3xl">
                <p className="text-xl text-muted-foreground text-neutral-200">
                Łączymy wolontariuszy z potrzebującymi
                Dołącz do nas, aby wprowadzać zmiany w swojej społeczności.
                </p>
              </div>
              {/* Buttons */}
              <div className="mt-8 gap-3 flex justify-center">
                <button className=" border border-slate-900 px-7 py-3 rounded-md bg-teal-400 font-semibold text-gray-900">Dołącz</button>
                <button className="border border-neutral-300 px-4 py-3 rounded-md text-neutral-50" >
                  Zobacz więcej
                </button>
              </div>
              {/* End Buttons */}
            </div>
          </div>
        </div>
      </div>
      {/* End Hero */}
    </>
  );
}

export default Hero;