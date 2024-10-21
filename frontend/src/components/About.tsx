import React from 'react';

const About: React.FC = () => {
  return (
    <div className="">
      <div className=" max-w-[94%] xl:max-w-[1580px] mx-auto min-h-[600px] py-10 ">
        <h2 className="text-4xl text-center font-semibold">O nas</h2>
        <div className="rounded-3xl relative overflow-visible  px-10 bg-violet-200/50 mt-20">
          <div className="grid grid-cols-1 xl:grid-cols-[2fr_1fr] md:px-9 md:gap-x-40 gap-4 py-12 relative">
            <div className="font-semibold py-6 text-blue-950 ">
              Jesteśmy platformą, która powstała z myślą o budowaniu mostów
              pomiędzy osobami potrzebującymi wsparcia a wolontariuszami gotowymi
              pomagać. Naszą misją jest tworzenie lokalnej sieci pomocy, dzięki
              której każdy, kto szuka wsparcia, znajdzie je szybko i łatwo, a
              wolontariusze mogą efektywnie wykorzystać swoje umiejętności i
              chęci do niesienia pomocy.
              <br />
              <br />
              Wierzymy, że siła społeczności tkwi w ludziach i ich gotowości do
              działania. Dlatego nasza aplikacja umożliwia łączenie
              potrzebujących z sąsiadami, którzy są gotowi podać pomocną dłoń –
              bez zbędnych barier i komplikacji. Naszym celem jest nie tylko
              pomoc w codziennych wyzwaniach, ale także budowanie więzi i
              solidarności w lokalnym otoczeniu.
              <br />
              <br />
              Inspiracją do stworzenia platformy była chęć wykorzystania
              nowoczesnych technologii do tego, co najważniejsze – wsparcia i
              empatii. W czasach, gdy często brakuje bezpośrednich kontaktów,
              chcemy przywrócić wartości wspólnoty i pomocy sąsiedzkiej,
              umożliwiając szybki i prosty dostęp do wsparcia.
              <br />
              <br />
              Dołącz do nas i razem twórzmy społeczność, która działa „tu i
              teraz”!
            </div>

            {/* Sekcja obrazu */}
            <div className="  xl:flex items-center justify-end hidden ">
              <img
                src="../../public/about.png"
                alt="About"
                className="absolute 2xl:max-w-[58%] xl:max-w-[66%] lg:max-w-[92%] md:max-w-[140%]   h-auto  bottom-0 rounded-3xl object-cover"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default About;
