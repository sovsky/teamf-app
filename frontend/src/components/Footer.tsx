import React from 'react';

const Footer: React.FC = () => {
  return (
    <footer className="bg-slate-900 text-neutral-100  py-12">
      <div className="max-w-[1580px] mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* Sekcja "O nas" */}
          <div>
            <h3 className="text-lg font-semibold mb-4">O nas</h3>
            <p className="text-sm">
              Nasza aplikacja łączy wolontariuszy z osobami potrzebującymi pomocy. Razem budujemy lepsze społeczeństwo.
            </p>
          </div>

          {/* Sekcja "Linki" */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Linki</h3>
            <ul className="space-y-2">
              <li>
                <a href="/about" className="text-sm hover:underline">O aplikacji</a>
              </li>
              <li>
                <a href="/faq" className="text-sm hover:underline">FAQ</a>
              </li>
              <li>
                <a href="/contact" className="text-sm hover:underline">Kontakt</a>
              </li>
              <li>
                <a href="/terms" className="text-sm hover:underline">Regulamin</a>
              </li>
            </ul>
          </div>

          {/* Sekcja "Kontakt" */}
          <div>
            <h3 className="text-lg font-semibold mb-4">Kontakt</h3>
            <p className="text-sm">Email: support@yourapp.com</p>
            <p className="text-sm">Telefon: +48 123 456 789</p>
          </div>
        </div>

        {/* Dolna sekcja praw autorskich */}
        <div className="text-center mt-8 border-t border-white/20 pt-4">
          <p className="text-sm">&copy; {new Date().getFullYear()} Twoja Aplikacja. Wszelkie prawa zastrzeżone.</p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
