<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\DataAPI;
use App\Models\DataSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class KrakenController extends Controller
{
    public function fetchOHLC(Request $request){
        try {
            ini_set('max_execution_time', 300);//5 menit
            if (DataAPI::exists()) {
                return back()->withErrors([
                    'file' => '🚨Data API sudah ada. Silakan hapus terlebih dahulu sebelum menambahkan data baru.⚠️',
                ]);
            }
            
            DB::beginTransaction();
            // Validasi form input
            $request->validate([
                'crypto_pair' => 'required',
                'date-start' => 'required|date',
                'date-end' => 'required|date|after_or_equal:date-start',
                'sumber' => 'required',
                'jenis_data' => 'required|in:Harian,Mingguan',
            ], [
                'crypto_pair.required' => '🚨Kolom Pilih Kripto wajib diisi.⚠️',
                'date-start.required' => '📅 Tanggal awal wajib diisi.',
                'date-start.date' => '📅 Format tanggal awal tidak valid.',
                'date-end.required' => '📅 Tanggal akhir wajib diisi.',
                'date-end.date' => '📅 Format tanggal akhir tidak valid.',
                'date-end.after_or_equal' => '⚠️ Tanggal akhir harus setelah atau sama dengan tanggal awal.',
                'sumber.required' => '🔎 Sumber data wajib diisi.',
                'jenis_data.required' => '📊 Jenis data harus dipilih.',
                'jenis_data.in' => '❗ Jenis data tidak valid.',
            ]);


            $displayNames = [
                // Beberapa koin besar:
                'XXBTZUSD' => 'Bitcoin (BTC) to USD',
                'ETCUSD' => 'Ethereum Classic (ETC) to USD',
                'XETHZUSD' => 'Ethereum (ETH) to USD',
                'XLTCZUSD' => 'Litecoin (LTC) to USD',
                'XDGUSD' => 'Dogecoin (DOGE) (XDG) to USD',
                'XCNUSD' => 'Onyxcoin (XCN) to USD',
                'MLNUSD' => 'Enzyme (MLN) to USD',
                'REPUSD' => 'Augur (REP) to USD',

                '1INCHUSD' => '1inch (1INCH) to USD',
                'AAVEUSD' => 'Aave (AAVE) to USD',
                'ACAUSD' => 'Acala (ACA) to USD',
                'ACHUSD' => 'Alchemy Pay (ACH) to USD',
                'ACTUSD' => 'Achain (ACT) to USD',
                'ACXUSD' => 'Access Protocol (ACX) to USD',
                'ADAUSD' => 'Cardano (ADA) to USD',
                'ADXUSD' => 'AdEx (ADX) to USD',
                'AEROUSD' => 'Aerodrome Finance (AERO) to USD',
                'AEVOUSD' => 'Aevo (AEVO) to USD',
                'AGLDUSD' => 'Adventure Gold (AGLD) to USD',
                'AI16ZUSD' => 'Ai 16z (AI16Z) to USD',  // Tidak ditemukan proyek pasti, sementara ini dibiarkan
                'AIRUSD' => 'AirCoin (AIR) to USD',
                'AIXBTUSD' => 'AIxBT (AIXBT) to USD',  // Asumsi nama proyek
                'AKTUSD' => 'Akash Network (AKT) to USD',
                'ALCHUSD' => 'Alchemist AI (ALCH) to USD',  // Ada beberapa "ALCH", diasumsikan ini
                'ALCXUSD' => 'Alchemix (ALCX) to USD',
                'ALGOUSD' => 'Algorand (ALGO) to USD',
                'ALICEUSD' => 'MyNeighborAlice (ALICE) to USD',
                'ALPHAUSD' => 'Alpha Venture DAO (ALPHA) to USD',
                'ALTUSD' => 'AltLayer (ALT) to USD',
                'ANKRUSD' => 'Ankr (ANKR) to USD',
                'ANLOGUSD' => 'Analog (ANLOG) to USD',
                'ANONUSD' => 'Anon (ANON) to USD',  // Tidak jelas, tetapi nama umum digunakan
                'APENFTUSD' => 'APENFT (APENFT) to USD',
                'APEUSD' => 'ApeCoin (APE) to USD',
                'API3USD' => 'API3 (API3) to USD',
                'APTUSD' => 'Aptos (APT) to USD',
                'APUUSD' => 'Apu Apustaja (APU) to USD',
                'ARBUSD' => 'Arbitrum (ARB) to USD',
                'ARCUSD' => 'ARC (ARC) to USD',  // Nama umum, tidak spesifik, perlu konfirmasi
                'ARKMUSD' => 'Arkham (ARKM) to USD',
                'ARPAUSD' => 'ARPA Chain (ARPA) to USD',
                'ARUSD' => 'Arweave (AR) to USD', 
                'ASTRUSD' => 'Astar (ASTR) to USD',
                'ATHUSD' => 'Aethir (ATH) to USD',  // Kurang populer, bisa juga "Athos Finance", perlu konfirmasi
                'ATLASUSD' => 'Star Atlas (ATLAS) to USD',
                'ATOMUSD' => 'Cosmos (ATOM) to USD',
                'AUCTIONUSD' => 'Bounce (AUCTION) to USD',
                'AUDIOUSD' => 'Audius (AUDIO) to USD',
                'AUDUSD' => 'Australian Dollar (AUD) to USD',  // Bukan kripto, ini fiat currency
                'AVAAIUSD' => 'AVA AI (AVAAI) to USD', 
                'AVAXUSD' => 'Avalanche (AVAX) to USD',
                'AXSUSD' => 'Axie Infinity (AXS) to USD',
                'B3USD' => 'B3 Coin (B3) to USD',
                'BABYUSD' => 'Baby (BABY) to USD',
                'BADGERUSD' => 'Badger DAO (BADGER) to USD',
                'BALUSD' => 'Balancer (BAL) to USD',
                'BANANAS31USD' => 'Banana (BANANAS31) to USD',
                'BANDUSD' => 'Band Protocol (BAND) to USD',
                'BATUSD' => 'Basic Attention Token (BAT) to USD',
                'BCHUSD' => 'Bitcoin Cash (BCH) to USD',
                'BEAMUSD' => 'Beam (BEAM) to USD',
                'BERAUSD' => 'Berachain (BERA) to USD', 
                'BICOUSD' => 'Biconomy (BICO) to USD',
                'BIGTIMEUSD' => 'Big Time (BIGTIME) to USD',
                'BIOUSD' => 'Bio Protocol (BIO) to USD', 
                'BITUSD' => 'BitDAO (BIT) to USD',
                'BLURUSD' => 'Blur (BLUR) to USD',
                'BLZUSD' => 'Bluzelle (BLZ) to USD',
                'BMTUSD' => 'Bubblemaps (BMT) to USD', 
                'BNBUSD' => 'Binance Coin (BNB) to USD',
                'BNCUSD' => 'Bifrost (BNC) to USD',
                'BNTUSD' => 'Bancor (BNT) to USD',
                'BOBAUSD' => 'Boba Network (BOBA) to USD',
                'BODENUSD' => 'Jeo Boden (BODEN) to USD',  // Meme coin populer
                'BONDUSD' => 'BarnBridge (BOND) to USD',
                'BONKUSD' => 'Bonk (BONK) to USD',
                'BRICKUSD' => 'r/Brick (BRICK) to USD',  // Reddit Community Points
                'BSXUSD' => 'Basilisk (BSX) to USD',
                'BTTUSD' => 'BitTorrent (BTT) to USD',
                'C98USD' => 'Coin98 (C98) to USD',
                'CAKEUSD' => 'PancakeSwap (CAKE) to USD',
                'CELOUSD' => 'Celo (CELO) to USD',
                'CELRUSD' => 'Celer Network (CELR) to USD',
                'CFGUSD' => 'Centrifuge (CFG) to USD',
                'CHRUSD' => 'Chromia (CHR) to USD',
                'CHZUSD' => 'Chiliz (CHZ) to USD',
                'CLOUDUSD' => 'Cloud (CLOUD) to USD',  // Asumsi dari token yang tersedia
                'CLVUSD' => 'Clover Finance (CLV) to USD',
                'COMPUSD' => 'Compound (COMP) to USD',
                'CORNUSD' => 'Corn Price (CORN) to USD',  // Asumsi, bisa juga token meme
                'COTIUSD' => 'COTI (COTI) to USD',
                'COWUSD' => 'CoW Protocol (COW) to USD',
                'CPOOLUSD' => 'Clearpool (CPOOL) to USD',
                'CQTUSD' => 'Covalent (CQT) to USD',
                'CROUSD' => 'Cronos (CRO) to USD',
                'CRVUSD' => 'Curve DAO (CRV) to USD',
                'CSMUSD' => 'Crust Shadow (CSM) to USD',
                'CTSIUSD' => 'Cartesi (CTSI) to USD',
                'CVCUSD' => 'Civic (CVC) to USD',
                'CVXUSD' => 'Convex Finance (CVX) to USD',
                'CXTUSD' => 'Covalent X (CXT) to USD',
                'CYBERUSD' => 'CyberConnect (CYBER) to USD',
                'DAIUSD' => 'Dai (DAI) to USD',
                'DASHUSD' => 'Dash (DASH) to USD',
                'DBRUSD' => 'deBridge (DBR) to USD', // asumsi, atau Debt Bearer Token?
                'DENTUSD' => 'Dent (DENT) to USD',
                'DOGSUSD' => 'Dogs (DOGS) to USD', // asumsi, bisa juga meme token lain
                'DOTUSD' => 'Polkadot (DOT) to USD',
                'DRIFTUSD' => 'Drift Protocol (DRIFT) to USD', // asumsi
                'DRVUSD' => 'Derive Price (DRV) to USD', // asumsi, simbol ini tidak umum
                'DUCKUSD' => 'DuckCoin (DUCK) to USD', // asumsi
                'DYDXUSD' => 'dYdX (DYDX) to USD',
                'DYMUSD' => 'Dymension (DYM) to USD',
                'EDGEUSD' => 'Edge Price (EDGE) to USD', // bisa banyak proyek, asumsi
                'EGLDUSD' => 'MultiversX (EGLD) to USD', // dulunya Elrond
                'EIGENUSD' => 'EigenLayer (EIGEN) to USD', // asumsi kripto baru
                'ELXUSD' => 'Elixir (ELX) to USD', // asumsi, bisa juga Energy Ledger
                'ENAUSD' => 'Ethena (ENA) to USD',
                'ENJUSD' => 'Enjin Coin (ENJ) to USD',
                'ENSUSD' => 'Ethereum Name Service (ENS) to USD',
                'EOSUSD' => 'EOS (EOS) to USD',
                'ETHFIUSD' => 'Ether.fi (ETHFI) to USD',
                'ETHPYUSD' => 'Etherpay (ETHPY) to USD', // asumsi, simbol tidak umum
                'ETHWUSD' => 'EthereumPoW (ETHW) to USD',
                'EULUSD' => 'Euler (EUL) to USD',
                'EUROPUSD' => 'Europ (EUROP) to USD', // asumsi, tidak umum
                'EURQUSD' => 'Quantoz (EURQ) to USD', // asumsi
                'EURRUSD' => 'StablR Euro (EURR) to USD',
                'EURTUSD' => 'Tether Euro (EURT) to USD',
                'EWTUSD' => 'Energy Web Token (EWT) to USD',
                'FARMUSD' => 'Harvest Finance (FARM) to USD',
                'FARTCOINUSD' => 'Fartcoin (FARTCOIN) to USD', // valid sebagai meme coin
                'FETUSD' => 'Fetch.ai (FET) to USD',
                'FHEUSD' => 'Fully Homomorphic Encryption (FHE) to USD', // asumsi
                'FIDAUSD' => 'Bonfida (FIDA) to USD',
                'FILUSD' => 'Filecoin (FIL) to USD',
                'FISUSD' => 'StaFi (FIS) to USD',
                'FLOKIUSD' => 'Floki Inu (FLOKI) to USD',
                'FLOWUSD' => 'Flow (FLOW) to USD',
                'FLRUSD' => 'Flare (FLR) to USD',
                'FLUXUSD' => 'Flux (FLUX) to USD',//
                'FORTHUSD' => 'Ampleforth Governance (FORTH) to USD',
                'FTMUSD' => 'Fantom (FTM) to USD',
                'FWOGUSD' => 'Fwog (FWOG) to USD', // asumsi, tidak umum di listing besar
                'FXSUSD' => 'Frax Share (FXS) to USD',
                'GALAUSD' => 'Gala (GALA) to USD',
                'GALUSD' => 'Project Galaxy (GAL) to USD',
                'GARIUSD' => 'Gari Network (GARI) to USD',
                'GFIUSD' => 'Goldfinch (GFI) to USD',
                'GHIBLIUSD' => 'Ghiblification (GHIBLI) to USD', // asumsi, bisa meme token tidak umum
                'GHSTUSD' => 'Aavegotchi (GHST) to USD',
                'GIGAUSD' => 'Gigachad (GIGA) to USD', // asumsi, GIGA bisa bermacam-macam
                'GLMRUSD' => 'Moonbeam (GLMR) to USD',
                'GMTUSD' => 'STEPN (GMT) to USD',
                'GMXUSD' => 'GMX (GMX) to USD',
                'GNOUSD' => 'Gnosis (GNO) to USD',
                'GOATUSD' => 'GoatCoin (GOAT) to USD', // asumsi, simbol ini bisa dipakai beberapa proyek
                'GRASSUSD' => 'Grass Price (GRASS) to USD', // asumsi, bisa proyek indexing AI
                'GRIFFAINUSD' => 'Griffain (GRIFFAIN) to USD', // asumsi, tidak dikenal luas
                'GRTUSD' => 'The Graph (GRT) to USD',
                'GSTUSD' => 'Green Satoshi Token (GST) to USD',
                'GTCUSD' => 'Gitcoin (GTC) to USD',
                'GUNUSD' => 'GUNZ (GUN) to USD', // asumsi, bisa proyek baru
                'GUSD' => 'Gemini Dollar (GUSD) to USD',
                'HDXUSD' => 'HydraDX (HDX) to USD',
                'HFTUSD' => 'Hashflow (HFT) to USD',
                'HMSTRUSD' => 'Hamster (HMSTR) to USD', // asumsi, bisa token meme
                'HNTUSD' => 'Helium (HNT) to USD',
                'HONEYUSD' => 'Hivemapper (HONEY) to USD', // asumsi, banyak token bernama sama
                'HPOS10IUSD' => 'HarryPotterObamaSonic10Inu (HPOS10I) to USD', // asumsi panjang, bisa index token
                'ICPUSD' => 'Internet Computer (ICP) to USD',
                'ICXUSD' => 'ICON (ICX) to USD',
                'IDEXUSD' => 'IDEX (IDEX) to USD',
                'IMXUSD' => 'Immutable (IMX) to USD',
                'INJUSD' => 'Injective (INJ) to USD',
                'INTRUSD' => 'Interlay (INTR) to USD',
                'IPUSD' => 'Story Price (IP) to USD', // asumsi, simbol ini tidak umum
                'JAILSTOOLUSD' => 'Jailstool (Stool Prisondente) to USD', // asumsi, sangat tidak umum
                'JASMYUSD' => 'JasmyCoin (JASMY) to USD',
                'JSTUSD' => 'JUST (JST) to USD',
                'JTOUSD' => 'Jito (JTO) to USD',//
                'JUNOUSD' => 'Juno (JUNO) to USD',
                'JUPUSD' => 'Jupiter (JUP) to USD',
                'KAITOUSD' => 'Kaito Price (KAITO) to USD', // diasumsikan Kaito AI
                'KARUSD' => 'Karura (KAR) to USD',
                'KASUSD' => 'Kaspa (KAS) to USD',
                'KAVAUSD' => 'Kava (KAVA) to USD',
                'KEEPUSD' => 'Keep Network (KEEP) to USD',
                'KERNELUSD' => 'KernelDAO (KERNEL) to USD', // asumsi, belum jelas proyeknya
                'KEYUSD' => 'SelfKey (KEY) to USD',
                'KILTUSD' => 'KILT Protocol (KILT) to USD',
                'KINTUSD' => 'Kintsugi (KINT) to USD',
                'KINUSD' => 'Kin (KIN) to USD',
                'KMNOUSD' => 'Kamino (KMNO) to USD',
                'KNCUSD' => 'Kyber Network Crystal (KNC) to USD',
                'KP3RUSD' => 'Keep3rV1 (KP3R) to USD',
                'KSMUSD' => 'Kusama (KSM) to USD',
                'KUJIUSD' => 'Kujira (KUJI) to USD',
                'KUSD' => 'Kolibri (KUSD) to USD', // asumsi berdasarkan KUSD stablecoin
                'L3USD' => 'Layer3 (L3) to USD', // asumsi, nama token bisa ambigu
                'LAYERUSD' => 'Layer (LAYER) to USD', // asumsi, bisa saja proyek yang belum dikenal
                'LCXUSD' => 'LCX (LCX) to USD',
                'LDOUSD' => 'Lido DAO (LDO) to USD',
                'LINKUSD' => 'Chainlink (LINK) to USD',
                'LITUSD' => 'Litentry (LIT) to USD',
                'LMWRUSD' => 'LimeWire (LMWR) to USD',
                'LOCKINUSD' => 'Lock IN (LOCKIN) to USD', // asumsi, tidak umum
                'LPTUSD' => 'Livepeer (LPT) to USD',
                'LQTYUSD' => 'Liquity (LQTY) to USD',
                'LRCUSD' => 'Loopring (LRC) to USD',
                'LSETHUSD' => 'Liquid Staked ETH (LSETH) to USD', 
                'LSKUSD' => 'Lisk (LSK) to USD',
                'LUNA2USD' => 'Terra 2.0 (LUNA2) to USD',
                'LUNAUSD' => 'Terra Classic (LUNA) to USD',
                'MANAUSD' => 'Decentraland (MANA) to USD',
                'MASKUSD' => 'Mask Network (MASK) to USD',
                'MATICUSD' => 'Polygon (MATIC) to USD',
                'MCUSD' => 'Merit Circle (MC) to USD',
                'MELANIAUSD' => 'Official Melania Meme (MELANIA) to USD', // asumsi, kemungkinan token meme
                'MEMEUSD' => 'Meme (MEME) to USD', // bisa jadi “Memecoin” by 9GAG
                'METISUSD' => 'Metis (METIS) to USD',
                'MEUSD' => 'ME (ME) to USD', // asumsi, tidak umum
                'MEWUSD' => 'MyEtherWallet Token (MEW) to USD', // asumsi, ada kemungkinan salah jika bukan itu
                'MICHIUSD' => 'Michi SOL (MICHI) to USD', // asumsi, bisa token meme
                'MINAUSD' => 'Mina Protocol (MINA) to USD',
                'MIRUSD' => 'Mirror Protocol (MIR) to USD',
                'MKRUSD' => 'Maker (MKR) to USD',
                'MNGOUSD' => 'Mango (MNGO) to USD',
                'MNTUSD' => 'Mantle (MNT) to USD',
                'MOGUSD' => 'Mog Coin (MOG) to USD',
                'MOODENGUSD' => 'Moo Deng (MOODENG) to USD',//
                'MOONUSD' => 'r/CryptoCurrency Moons (MOON) to USD',
                'MORPHOUSD' => 'Morpho (MORPHO) to USD',
                'MOVEUSD' => 'Move Network (MOVE) to USD', // ada beberapa "Move", ini asumsi berdasarkan popularitas
                'MOVRUSD' => 'Moonriver (MOVR) to USD',
                'MSOLUSD' => 'Marinade Staked SOL (mSOL) to USD',
                'MULTIUSD' => 'Multichain (MULTI) to USD',
                'MVUSD' => 'GensoKishi Metaverse (MV) to USD',
                'MXCUSD' => 'MXC (MXC) to USD',
                'NANOUSD' => 'Nano (XNO) to USD', // ticker resmi telah diganti dari NANO menjadi XNO
                'NEARUSD' => 'NEAR Protocol (NEAR) to USD',
                'NEIROUSD' => 'Neiro (NEIRO) to USD', // tidak umum, asumsinya sesuai nama token
                'NILUSD' => 'Nillion (NIL) to USD', // asumsi, verifikasi perlu dilakukan jika proyek baru
                'NMRUSD' => 'Numeraire (NMR) to USD',
                'NODLUSD' => 'Nodle (NODL) to USD',
                'NOSUSD' => 'Nosana (NOS) to USD',
                'NOTUSD' => 'Notcoin (NOT) to USD',
                'NTRNUSD' => 'Neutron (NTRN) to USD',
                'NYMUSD' => 'NYM (NYM) to USD',
                'OCEANUSD' => 'Ocean Protocol (OCEAN) to USD',
                'ODOSUSD' => 'Odos (ODOS) to USD', // proyek DEX aggregator
                'OGNUSD' => 'Origin Protocol (OGN) to USD',
                'OMGUSD' => 'OMG Network (OMG) to USD',
                'OMNIUSD' => 'Omni Network (OMNI) to USD',
                'OMUSD' => 'MANTRA (OM) to USD', // dulunya MANTRA DAO
                'ONDOUSD' => 'Ondo Finance (ONDO) to USD',
                'OPUSD' => 'Optimism (OP) to USD',
                'ORCAUSD' => 'Orca (ORCA) to USD',
                'OSMOUSD' => 'Osmosis (OSMO) to USD',
                'OXTUSD' => 'Orchid (OXT) to USD',
                'OXYUSD' => 'Oxygen (OXY) to USD',
                'PAXGUSD' => 'PAX Gold (PAXG) to USD',
                'PDAUSD' => 'PlayDapp (PDA) to USD',
                'PENDLEUSD' => 'Pendle (PENDLE) to USD',
                'PENGUUSD' => 'Pudgy Penguins (PENGU) to USD', 
                'PEPEUSD' => 'Pepe (PEPE) to USD',
                'PERPUSD' => 'Perpetual Protocol (PERP) to USD',
                'PHAUSD' => 'Phala Network (PHA) to USD',
                'PNUTUSD' => 'Peanut the Squirrel (PNUT) to USD', // proyek kecil
                'POLISUSD' => 'Star Atlas DAO (POLIS) to USD',
                'POLSUSD' => 'Polkastarter (POLS) to USD',
                'POLUSD' => 'Polygon Ecosystem Token (POL) to USD',
                'PONDUSD' => 'Marlin (POND) to USD',
                'PONKEUSD' => 'Ponke SOL (PONKE) to USD', // token meme Solana
                'POPCATUSD' => 'Popcat SOL (POPCAT) to USD', // token meme Solana
                'PORTALUSD' => 'Portal (PORTAL) to USD', // asumsi, proyek gaming
                'POWRUSD' => 'Power Ledger (POWR) to USD',
                'PRCLUSD' => 'Parcl (PRCL) to USD',
                'PRIMEUSD' => 'Echelon Prime (PRIME) to USD',
                'PROMPTUSD' => 'Wayfinder (PROMPT) to USD',
                'PSTAKEUSD' => 'pSTAKE Finance (PSTAKE) to USD',//
                'PUFFERUSD' => 'Puffer Finance (PUFFER) to USD',
                'PYTHUSD' => 'Pyth Network (PYTH) to USD',
                'PYUSD' => 'PayPal USD (PYUSD) to USD',
                'QNTUSD' => 'Quant (QNT) to USD',
                'QTUMUSD' => 'Qtum (QTUM) to USD',
                'RADUSD' => 'Radworks (RAD) to USD',
                'RAREUSD' => 'SuperRare (RARE) to USD',
                'RARIUSD' => 'Rarible (RARI) to USD',
                'RAYUSD' => 'Raydium (RAY) to USD',
                'RBCUSD' => 'Rubic (RBC) to USD',
                'REDUSD' => 'Red Token (RED) to USD', // asumsi, token kurang populer
                'RENDERUSD' => 'Render (RNDR) to USD',
                'RENUSD' => 'Ren (REN) to USD',
                'REPV2USD' => 'Augur v2 (REPv2) to USD',
                'REQUSD' => 'Request (REQ) to USD',
                'REZUSD' => 'Renzo (REZ) to USD',
                'RLCUSD' => 'iExec RLC (RLC) to USD',
                'RLUSD' => 'Reserve (RLUSD) to USD',
                'ROOKUSD' => 'Rook Price (ROOK) to USD', // meskipun proyek sudah tidak aktif, ini nama resminya
                'RPLUSD' => 'Rocket Pool (RPL) to USD',
                'RSRUSD' => 'Reserve Rights (RSR) to USD',
                'RUNEUSD' => 'THORChain (RUNE) to USD',
                'SAFEUSD' => 'Safe (SAFE) to USD', // proyek baru, bisa juga SafeCoin
                'SAGAUSD' => 'Saga (SAGA) to USD',
                'SAMOUSD' => 'Samoyedcoin (SAMO) to USD',
                'SANDUSD' => 'The Sandbox (SAND) to USD',
                'SBRUSD' => 'Saber (SBR) to USD',
                'SCRTUSD' => 'Secret (SCRT) to USD',
                'SCUSD' => 'Siacoin (SC) to USD',
                'SDNUSD' => 'Shiden Network (SDN) to USD',
                'SEIUSD' => 'Sei (SEI) to USD',
                'SGBUSD' => 'Songbird (SGB) to USD',
                'SHIBUSD' => 'Shiba Inu (SHIB) to USD',
                'SIGMAUSD' => 'Sigma (SIGMA) to USD', // asumsi proyek baru
                'SKYUSD' => 'Skycoin (SKY) to USD',
                'SNXUSD' => 'Synthetix (SNX) to USD',
                'SOLUSD' => 'Solana (SOL) to USD',
                'SONICUSD' => 'Sonic (SONIC) to USD', // token baru berbasis Solana
                'SPELLUSD' => 'Spell Token (SPELL) to USD',
                'SPICEUSD' => 'Spice (SPICE) to USD', // banyak versi, perlu konfirmasi
                'SPXUSD' => 'SPX6900 (SPX) to USD', // kemungkinan meme coin, atau S&P tracker di blockchain
                'SRMUSD' => 'Serum (SRM) to USD',
                'SSVUSD' => 'SSV Network (SSV) to USD',
                'STEPUSD' => 'Step Finance (STEP) to USD',
                'STGUSD' => 'Stargate Finance (STG) to USD',
                'STORJUSD' => 'Storj (STORJ) to USD',
                'STRDUSD' => 'Stride (STRD) to USD',
                'STRKUSD' => 'Starknet (STRK) to USD',
                'STXUSD' => 'Stacks (STX) to USD',
                'SUIUSD' => 'Sui (SUI) to USD',//
                'SUNDOGUSD' => 'Sundog (SUNDOG) to USD', // proyek baru, diasumsikan benar
                'SUNUSD' => 'Sun Token (SUN) to USD',
                'SUPERUSD' => 'SuperVerse (SUPER) to USD',
                'SUSHIUSD' => 'SushiSwap (SUSHI) to USD',
                'SWARMSUSD' => 'Swarms (SWARMS) to USD', // proyek baru, perlu verifikasi
                'SWELLUSD' => 'Swell Network (SWELL) to USD',
                'SYNUSD' => 'Synapse (SYN) to USD',
                'SYRUPUSD' => 'Mapple Finance (SYRUP) to USD',
                'TAOUSD' => 'Bittensor (TAO) to USD',
                'TBTCUSD' => 'tBTC (TBTC) to USD',
                'TEERUSD' => 'Integritee (TEER) to USD',
                'TERMUSD' => 'TERMINAL (TERM) to USD', // asumsi token proyek
                'TIAUSD' => 'Celestia (TIA) to USD',
                'TITCOINUSD' => 'Titcoin (TIT) to USD', // kode sebenarnya TIT
                'TLMUSD' => 'Alien Worlds (TLM) to USD',
                'TNSRUSD' => 'Tensor (TNSR) to USD',
                'TOKENUSD' => 'TokenFi (TOKEN) to USD', // banyak versi, asumsi yang populer
                'TOKEUSD' => 'Tokemak (TOKE) to USD',
                'TONUSD' => 'Toncoin (TON) to USD',
                'TOSHIUSD' => 'Toshi (TOSHI) to USD', // meme coin Solana
                'TRACUSD' => 'OriginTrail (TRAC) to USD',
                'TREMPUSD' => 'TREMP (TREMP) to USD', // meme coin
                'TRUMPUSD' => 'MAGA (TRUMP) to USD', // banyak varian TRUMP, asumsi populer
                'TRUUSD' => 'TrueFi (TRU) to USD',
                'TRXUSD' => 'TRON (TRX) to USD',
                'TURBOUSD' => 'Turbo (TURBO) to USD',
                'TVKUSD' => 'Virtua (TVK) to USD',
                'UFDUSD' => 'Unicorn Fart Dust (UFD) to USD', // asumsi
                'UMAUSD' => 'UMA (UMA) to USD',
                'UNFIUSD' => 'Unifi Protocol DAO (UNFI) to USD',
                'UNIUSD' => 'Uniswap (UNI) to USD',
    
                // Stablecoin / symbol konflik yang perlu koreksi:
                'CUSD' => 'Celo Dollar (cUSD) to USD',
                'DUSD' => 'DUSD (DUSD) to USD', // Decentralized USD, variasi tergantung platform
                'GUSD' => 'Gemini Dollar (GUSD) to USD',
                'QUSD' => 'QUSD (QUSD) to USD', // tidak umum, bisa jadi placeholder
                'RUSD' => 'RUSD (RUSD) to USD', // asumsi Reserve USD
                'SUSD' => 'sUSD (sUSD) to USD',
                'TUSD' => 'TrueUSD (TUSD) to USD', // perbaikan, sebelumnya ganda
                'USTUSD' => 'TerraClassicUSD (USTC) to USD',
    
                'USUALUSD' => 'Usual (USUAL) to USD', // proyek stablecoin berbasis real-world assets
                'VANRYUSD' => 'Vanar Chain (VANRY) to USD',
                'VELODROMEUSD' => 'Velodrome Finance (VELO) to USD', // simbol VELO
                'VINEUSD' => 'Vine (VINE) to USD', // tidak umum, perlu verifikasi
                'VIRTUALUSD' => 'Virtual (VIRTUAL) to USD',
                'VVVUSD' => 'Veni Vidi Vici (VVV) to USD',
                'WALUSD' => 'Walrus (WAL) to USD', // asumsi token tidak umum
                'WAXLUSD' => 'WAXL (WAXL) to USD',
                'WBTCUSD' => 'Wrapped Bitcoin (WBTC) to USD',//
                'WCTUSD' => 'Waves Community Token (WCT) to USD',
                'WELLUSD' => 'Moonwell (WELL) to USD',
                'WENUSD' => 'WEN (WEN) to USD', // meme coin Solana
                'WIFUSD' => 'dogwifhat (WIF) to USD',
                'WINUSD' => 'WINkLink (WIN) to USD',
                'WLDUSD' => 'Worldcoin (WLD) to USD',
                'WOOUSD' => 'WOO Network (WOO) to USD',
    
                // Simbol generik yang perlu klarifikasi — sebelumnya salah atau placeholder:
                'WUSD' => 'WUSD (WUSD) to USD', // bisa berarti Wrapped USD, perlu sumber resmi
                'XBTPYUSD' => 'XBT Provider (XBTPY) to USD', // exchange-traded product, bukan token blockchain
    
                // Entitas tidak umum:
                'XRPRLUSD' => 'Ripple (XRPRL) to USD', // kemungkinan salah tulis dari XRP — jika ya, seharusnya:
                'XRPUSD' => 'Ripple (XRP) to USD',
                'XRTUSD' => 'Robonomics Network (XRT) to USD',
                'XTZUSD' => 'Tezon (XTZ) to USD',
                
                'XLMUSD' => 'Stellar Lumens (XLM) to USD',
                'XMRUSD' => 'Monero (XMR) to USD',
                'XRPUSD' => 'XRP to USD',
                'ZECUSD' => 'Zcash (ZEC) to USD',
                'YFIUSD' => 'Yearn Finance (YFI) to USD',
                'YGGUSD' => 'Yield Guild Games (YGG) to USD',
                'ZEREBROUSD' => 'Zerebro to USD',
                'ZETAUSD' => 'ZetaChain (ZETA) to USD',
                'EURUSD' => 'EUR to USD',
                'ZEUSUSD' => 'Zeus Network (ZEUS) to USD',
                'ZEXUSD' => 'Zeta (ZEX) to USD',
                'GBPUSD' => 'Binance GBP Stable to USD',
                'ZKUSD' => 'ZKsync (ZK) to USD',
                'ZROUSD' => 'LayerZero (Zro) to USD',
                'ZRXUSD' => '0x Protocol (ZRX) to USD',
                'ZORAUSD' => 'Zora Price (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
                'ZORAUSD' => ' (ZORA) to USD',
            ];
            
            $displayName = $displayNames[$request->crypto_pair] ?? $request->crypto_pair;
            $fullName = $displayNames[$request->crypto_pair] ?? $request->crypto_pair;
            $displayName = explode('(', $fullName)[0];
            $displayName = trim($displayName);

            // Simpan ke data_source
            $dataSource = DataSource::create([
                'name' => $request->crypto_pair,
                'display_name' => $displayName,
                'periode_awal' => $request['date-start'],
                'periode_akhir' => $request['date-end'],
                'sumber' => $request->sumber,
                'jenis_data' => $request->jenis_data,
            ]);

            $start = Carbon::parse($request['date-start'], 'Asia/Jakarta')->startOfDay();
            $end = Carbon::parse($request['date-end'], 'Asia/Jakarta')->endOfDay();

            $startTime = $start->subDay()->timestamp; // sesuai kebutuhan Kraken
            $endTime = $end->timestamp;
            $pair = $request->crypto_pair;
            $interval = $request->jenis_data === 'Mingguan' ? 10080 : 1440; // 1440 harian, 10080 mingguan

            $response = Http::withOptions([
                'verify' => storage_path('cacert.pem')
            ])->get("https://api.kraken.com/0/public/OHLC", [
                'pair' => $pair,
                'interval' => $interval,
                'since' => $startTime,
            ]);

            $data = $response->json();

            // Validasi response
            if (!isset($data['result'])) {
                return redirect()->back()->with('error', 'Gagal mengambil data dari Kraken.');
            }

            $pairKey = array_key_first($data['result']);
            $ohlcData = $data['result'][$pairKey] ?? [];

            if (empty($ohlcData)) {
                return redirect()->back()->with('error', 'Tidak ada data ditemukan dari Kraken.');
            }

            // Simpan data (maksimal 720 data)
            foreach ($ohlcData as $item) {
                $parsedDate = Carbon::createFromTimestampUTC($item[0])->setTimezone('Asia/Jakarta')->startOfDay();

                if ($parsedDate->gte($start) && $parsedDate->lte($end)) {
                    DataAPI::updateOrCreate(
                        [
                            'source_id' => $dataSource->id,
                            'date' => $parsedDate->format('m-d-Y'),
                        ],
                        [
                            'open' => $item[1],
                            'high' => $item[2],
                            'low' => $item[3],
                            'close' => $item[4],
                            'vwap' => $item[5],
                            'vol' => $item[6],
                            'count' => $item[7],
                        ]
                    );
                }
            }
            DB::commit();
            session()->push('notifications', [
                'icon' => 'mdi-flag-variant',
                'bgColor' => 'info',
                'title' => 'Data API Berhasil Dipilih',
                'text' => 'Data sudah siap untuk dilakukan pra-proses.', 
                'time' => Carbon::now()->toDateTimeString(), 
            ]);
            return response()->json(['message' => 'Data berhasil diambil dan disimpan.']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Gagal mengambil data.'], 500);
        }
    }
}
