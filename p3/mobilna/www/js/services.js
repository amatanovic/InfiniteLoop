angular.module('starter.services', [])

.factory('Trivije', function() {
		var trivije = [
			{
			broj: 0,
			trivija: 'Zanimljivosti će vam se listati same svakih nekoliko sekundi. Uživajte i naučite nešto novo!'
			}, 
			{
			broj: 1,
			trivija: 'Kosa raste oko 1,5 centimetar mjesečno.'
			}, 

			{
			broj: 2,
			trivija: 'Kosa nešto više raste ljeti nego za vrijeme hladnih mjeseci.'
			}, 

			{
			broj: 3,
			trivija: 'Iz jednog folikula vlasi izraste 20 do 25 vlasi.'
			}, 

			{
			broj: 4,
			trivija: 'U prosjeku, vlas raste 0,35 mm u 24 sata, što iznosi oko 12 cm u jednoj godini.'
			}, 

			{
			broj: 5,
			trivija: 'Najpogodnija temperatura vode za pranje kose je 35 do 45 C.'
			}, 

			{
			broj: 6,
			trivija: 'Životni ciklus vlasi u prosjeku traje pet i pol godina.'
			}, 

			{
			broj: 7,
			trivija: 'U prosjeku, ljudsko vlasište ima 100 000 vlasi.'
			}, 

			{
			broj: 8,
			trivija: 'Osim koštane srži, vlas je najbrže rastuće tkivo u ljudskom tijelu.'
			}, 

			{
			broj: 9,
			trivija: 'Vlas je sastavljena od keratina, iste tvari koja čini nokte i barijeru na vrhu kože.'
			}, 

			{
			broj: 10,
			trivija: 'Sadržaj vode u vašoj kosi može dostići 30%.'
			}, 

			{
			broj: 11,
			trivija: 'Zbog velike količine ženskih hormona, ženska vlas je zaštićenija od testosterona i time manje sklona gubitku kose.'
			}, 

			{
			broj: 12,
			trivija: 'Izgledi da kosa postane sjeda se povećavaju 10-20% svako desetljeće nakon 30 godina starosti.'
			}, 

			{
			broj: 13,
			trivija: 'Rezanje, bojanje, izbjeljivanje ili trajna frizura se ne preporučuju neposredno prije i tijekom menstruacije. Povišene vrijednosti estrogena mogu promijeniti učinak.'
			}, 

			{
			broj: 14,
			trivija: 'Tijekom menstruacijskog ciklusa vlasište je osjetljivije.'
			}, 

			{
			broj: 15,
			trivija: 'Boja kose se određuje količinom pigmenta kose i oblikom pigmentih stanica.'
			}, 

			{
			broj: 16,
			trivija: 'Za vrlo hladnog vremena kosa je suša i tanja.'
			}, 

			{
			broj: 17,
			trivija: 'Ljudska kosa je čvršća od bakrene žice iste debljine.'
			}, 

			{
			broj: 18,
			trivija: 'U prosjeku, osobe svjetlije kose imaju 140 000 vlasi, osobe smeđe kosom imaju 102 000 do 109 000 vlasi, osobe crne kose imaju 110 000 vlasi,a osobe crvene kose imaju 90 000 vlasi.'
			}, 

			{
			broj: 19,
			trivija: 'Kosa sijedi sa starenjem zbog umiranja pigmentnih stanica u folikulu vlasi koje prestaju stvarati melanin koji daje kosi boju.'
			}, 

			{
			broj: 20,
			trivija: 'Pamučne jastučnice su loše za vašu kosu.'
			}, 

			{
			broj: 21,
			trivija: 'Najduža kosa ikada, je navodno bila duga 7,93 metara, i to je bila kosa Indijke koja je živjela krajem 40-ih prošlog stoljeća.'
			}, 

			{
			broj: 22,
			trivija: 'Od 100 žena i muškaraca starosne dobi između 24 i 34 godine, 56% muškaraca svakodnevno pere kosu, dok to čini samo 30% žena iste životne dobi.'
			}, 

			{
			broj: 23,
			trivija: 'Zlatokosi bi trebalo oko 100 godina da joj izraste onolika kosa. '
			}, 

			{
			broj: 24,
			trivija: 'MIT: Šišanje vrhova ubrzava rast kose.'
			}, 

			{
			broj: 25,
			trivija: 'MIT: Mijenjanje šampona utječe na rast kose.'
			}, 

			{
			broj: 26,
			trivija: 'MIT: Ako iščupam jednu sijedu, dvije nove će izrasti.'
			}, 

			{
			broj: 27,
			trivija: 'MIT: Tankoj kosi nema pomoći, ne može biti punija. '
			}, 

			{
			broj: 28,
			trivija: 'MIT: Ispiranje hladnom i toplom vodom daje sjaj kosi. '
			}, 

			{
			broj: 29,
			trivija: 'MIT: Postoje sredstva koja će zaliječiti ispucale vrhove.'
			}, 

			{
			broj: 30,
			trivija: 'MIT: Za zdravu kosu treba svakodnevnom češljem kroz nju proći sto puta.'
			},

			{
			broj: 31,
			trivija: 'MIT: Masiranje tjemena stimulira rast kose.'
			},

			{
			broj: 32,
			trivija: 'MIT: Pjena je jamstvo da šampon radi svoje.'
			},

			{
			broj: 32,
			trivija: 'Došli ste do kraja. Nadamo se da ste uživali.'
			}
		];

		return {
			all: function() {
				return trivije;
			}
		};
	});
			