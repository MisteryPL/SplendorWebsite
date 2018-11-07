<?php
class Strona
{
	protected $zawartosc;
	protected $tytul;
        protected $baner;
	protected $przyciski =
	array
	(
		"Główna" => "?strona=index",
                "Logowanie" => "?strona=logowanie",
		"Rejestracja" => "?strona=rejestracja",
                "Zasady Gry" => "?strona=zasady",
                "Ranking" => "?strona=ranking",
	);

	public function ustaw_zawartosc($nowa_zawartosc)
	{
		$this->zawartosc = $nowa_zawartosc;
	}

	function ustaw_tytul($nowy_tytul)
	{
		$this->tytul = $nowy_tytul;
	}
        
        function ustaw_baner($nowy_baner)
	{
		$this->baner = $nowy_baner;
	}

	public function ustaw_przyciski($nowe_przyciski)
	{
		$this->przyciski = $nowe_przyciski;
	}

	public function ustaw_style($url)
	{
		echo '<link rel="stylesheet" href=' . $url . ' type="text/css" />';
	}

	public function wyswietl()
	{
		$this->wyswietl_naglowek();
                $this->wyswietl_baner();
                $this->wyswietl_galerie();
		$this->wyswietl_zawartosc();
		$this->wyswietl_stopke();
	}

        public function wyswietl_baner()
        {
            echo $this->baner;
        }

        public function wyswietl_galerie()
        {   
            echo '<div id="galeria"> Ewentualna galeria </div>'; 
        }

	public function wyswietl_menu()
	{
            echo "<div id=\"pasek\">
            <ul id=\"nav\">";
            while (list($nazwa, $url) = each($this->przyciski))
            {   
		echo '<li> <a href="' . $url . '">' . $nazwa . '</a><li>';
            }
            echo "</ul></div>";
	}

	public function wyswietl_naglowek()
	{
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=true">
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
                <script src="JS/SlideshowJS.js" type="text/javascript"></script>
		<?php
                    echo "<title>".$this->tytul."</title></head><body>";
	}

	public function wyswietl_zawartosc()
	{
            $this->wyswietl_menu();
            echo $this->zawartosc;
	}

	public function wyswietl_stopke()
	{
		echo '<div id="stopka"> Kopirajt 2018 </div>';
		echo '</body></html>';
	}
}
?>