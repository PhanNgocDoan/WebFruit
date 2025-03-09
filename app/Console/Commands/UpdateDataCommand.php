<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class UpdateDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete';
    /**
     * Execute the console command.
     */
    public function handle()
    {
            $tongdoanhthu=DB::table('hoadon')
            ->whereYear('hoadon.NgayLapHD',Carbon::now()->year)->select('*')->sum('ThanhTien');
            //
            $chiphi=DB::table('hoadon')
            ->join('ct_hoadon','hoadon.MaHD','ct_hoadon.MaHD')
            ->whereYear('hoadon.NgayLapHD',Carbon::now()->year)
            ->join('nhaphang','nhaphang.MaTraiCay','ct_hoadon.MaTraiCay')
            ->select(DB::raw('SUM(nhaphang.GiaNhap * ct_hoadon.SoLuong) AS totalCost'))
            ->first()->totalCost;
            //
             DB::table('thongke')->insert(array([
            'MaThongKe'=>$this->createID(),
            'TongDoanhThu'=> $tongdoanhthu-=$chiphi,
            'Date'=> Carbon::now(),
            'ChiPhi'=>$chiphi
        ]));
    }
    // Tao ma moi thong ke
   public function createID()
   {
        $max=DB::table('thongke')->max('MaThongKe');
        $tk=DB::table('thongke')->select('*')->get();
            for($i=1;$i<=$max;$i++){
                $flag=false;
                foreach($tk as $row)
                {
                    if($i==$row->MaThongKe)
                    {
                        $flag=true;
                        break;
                    }
                }
                if($flag==false){
                  return $i;
                }
            }
            return $max+1;
   }
}