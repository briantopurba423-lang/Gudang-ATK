<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Kategori;

class AuthController extends Controller
{
    public function home()
    {
        $totalBarang   = Barang::count();
        $totalSupplier = Supplier::count();
        $barangMasuk   = DB::table('barang_masuk')->sum('jumlah');
        $barangKeluar  = DB::table('barang_keluar')->sum('jumlah');

        return view('pages.home', compact('totalBarang', 'totalSupplier', 'barangMasuk', 'barangKeluar'))
            ->with('active', 'home');
    }

    public function product()
    {
        $barang = Barang::with('kategori')->get();
        return view('pages.product', compact('barang'))->with('active', 'product');
    }

    public function showLogin()
    {
        return view('pages.login')->with('active', 'login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required'
        ]);

        $user = DB::table('users')
            ->where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('username', $user->username);
            Session::put('role', $user->role);
            Session::put('status', 'login');

            // Redirect berdasarkan role
            if ($user->role === 'manager') {
                return redirect()->route('manager.dashboard');
            }

            return redirect()->route('index');
        }

        return back()->with('error', 'Username, password, atau role salah!');
    }

    public function index()
    {
        if (!Session::get('status')) {
            return redirect()->route('login.form');
        }

        $totalBarang   = Barang::count();
        $totalSupplier = Supplier::count();
        $barang        = Barang::with('kategori')->get();
        $supplier      = Supplier::all();
        $kategori      = Kategori::withCount('barangs')->get();
        $barangMasuk   = DB::table('barang_masuk')->sum('jumlah');
        $barangKeluar  = DB::table('barang_keluar')->sum('jumlah');

        $riwayatMasuk = DB::table('barang_masuk')
            ->join('barangs', 'barang_masuk.barang_id', '=', 'barangs.id')
            ->leftJoin('suppliers', 'barang_masuk.supplier_id', '=', 'suppliers.id')
            ->select('barangs.nama', 'barang_masuk.jumlah', 'barang_masuk.tanggal', 'suppliers.nama as nama_supplier')
            ->orderByDesc('barang_masuk.tanggal')
            ->get();

        $riwayatKeluar = DB::table('barang_keluar')
            ->join('barangs', 'barang_keluar.barang_id', '=', 'barangs.id')
            ->select('barangs.nama', 'barang_keluar.jumlah', 'barang_keluar.tanggal')
            ->orderByDesc('barang_keluar.tanggal')
            ->get();

        return view('pages.index', compact(
            'totalBarang',
            'totalSupplier',
            'barang',
            'supplier',
            'kategori',
            'barangMasuk',
            'barangKeluar',
            'riwayatMasuk',
            'riwayatKeluar'
        ))->with('hideNav', true);
    }

    public function dashboardManager()
    {
        if (!Session::get('status')) {
            return redirect()->route('login.form');
        }

        $totalBarang   = Barang::count();
        $totalSupplier = Supplier::count();
        $stokMenipis   = Barang::where('stok', '>', 0)->where('stok', '<', 10)->count();
        $stokHabis     = Barang::where('stok', 0)->count();
        $totalMasuk    = DB::table('barang_masuk')->sum('jumlah');
        $totalKeluar   = DB::table('barang_keluar')->sum('jumlah');

        $lowStock = Barang::where('stok', '<', 10)->orderBy('stok')->get();

        $riwayatMasuk = DB::table('barang_masuk')
            ->join('barangs', 'barang_masuk.barang_id', '=', 'barangs.id')
            ->leftJoin('suppliers', 'barang_masuk.supplier_id', '=', 'suppliers.id')
            ->select('barangs.nama', 'barang_masuk.jumlah', 'barang_masuk.tanggal', 'suppliers.nama as nama_supplier')
            ->orderByDesc('barang_masuk.tanggal')->limit(10)->get();

        $riwayatKeluar = DB::table('barang_keluar')
            ->join('barangs', 'barang_keluar.barang_id', '=', 'barangs.id')
            ->select('barangs.nama', 'barang_keluar.jumlah', 'barang_keluar.tanggal')
            ->orderByDesc('barang_keluar.tanggal')->limit(10)->get();

        // Data chart 7 hari terakhir
        $chartLabels = [];
        $chartMasuk  = [];
        $chartKeluar = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->format('d/m');
            $chartMasuk[]  = DB::table('barang_masuk')->whereDate('tanggal', $date)->sum('jumlah');
            $chartKeluar[] = DB::table('barang_keluar')->whereDate('tanggal', $date)->sum('jumlah');
        }

        return view('pages.dashboard-manager', compact(
            'totalBarang', 'totalSupplier', 'stokMenipis', 'stokHabis',
            'totalMasuk', 'totalKeluar', 'lowStock',
            'riwayatMasuk', 'riwayatKeluar',
            'chartLabels', 'chartMasuk', 'chartKeluar'
        ))->with('hideNav', true);
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login.form');
    }
}
