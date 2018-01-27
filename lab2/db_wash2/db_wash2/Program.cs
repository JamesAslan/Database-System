using System;
using System.IO;

class Test
{
    static string[] all_station = new string[10000];
    static int Station_max = 1;
    static StreamWriter as_wr;
    static StreamWriter ts_wr;
    static StreamWriter tl_wr;
    static StreamWriter od_wr;
    static StreamReader us_rd;
    static int order_cnt=0;
    static int DATE_FROM = 0;
    static int DATE_TO = 7;
    static int users_cnt = 0;
    static users[] useri = new users[100];

    public struct users{
        public string id;
        public int order_cnt;
        public int[] sday;
        public int[] stimeint;
        public int[] etimeint;
    };

    public static void Record_stationlist()//只是把all-stations.txt 从磁盘到内存 
    {
        StreamReader sr = new StreamReader(@"E:\UCAS\sjk数据库\train-2016-10-v4\train-2016-10\all-stations.txt");
        int linei = 0;
        string line;
        string[] in_i;
        while ((line = sr.ReadLine()) != null)
        {
            linei++;

            in_i = line.Split(',');
            in_i[0] = in_i[0].Trim();

            string line_out = in_i[2] + "," + in_i[1] + "," + in_i[0];
            all_station[Convert.ToInt32(in_i[0])] = in_i[1]; //Record (station_name_i, outerstationid_i) to memory
            if (Convert.ToInt32(in_i[0]) > Station_max)
                Station_max = Convert.ToInt32(in_i[0]);

        }

    }

    public static void Wash_stationlist() //把all-stations从磁盘洗数据到trainofcity.tbl
    {
        StreamWriter wr = new StreamWriter(@"E:\UCAS\sjk数据库\Lab2\train_v7\data\trainsofcity.tbl");
        StreamReader sr = new StreamReader(@"E:\UCAS\sjk数据库\train-2016-10-v4\train-2016-10\all-stations.txt");
        int linei = 0;
        string line;
        string[] in_i;
        while ((line = sr.ReadLine()) != null)
        {
            linei++;

            in_i = line.Split(',');
            in_i[0]=in_i[0].Trim();
            
            string line_out = in_i[2] + "," + in_i[1] + "," + in_i[0];

            Console.WriteLine(line_out);
            wr.WriteLine(line_out);
        }
        wr.Close();

    }

    public static int FindStationOuterID(string StationName) //循环从trainsofcity中读出OuterStationID值
    {
        int i;
        for (i = 0; i <= Station_max; i++)
        {
            if (StationName == all_station[i])
                return i;
        }
        return -1;
    }

    public static int Time2Minint(string t) //把时间转换成分钟表示
    {
        string[] tmp = t.Split(':');
        return Convert.ToInt32(tmp[0])*60+Convert.ToInt32(tmp[1]);
    }

    public static void Wash_filei(string inputfile)
    {
        StreamReader sr = new StreamReader(inputfile);
        int id, tmp,linei=-1;
        string line;
        string[] in_i;
        string[] out_i;
        string[] out_tsfile = new string[100];
        string[] out_asfile = new string[100];
        string[] st_name = new string[100];
        int[] st_stimeint = new int[100];
        int[] st_forbidflag = new int[100];
        int[] st_deltaday = new int[100];
        FileInfo ifile = new FileInfo(inputfile);
        string checi = ifile.Name;
        int ArriveTime_min;
        int StartTime_min;
        int Delta_day=0;
        int Forbid_Flag;
        int[] enarr = new int[7];
        string last_starttimemin = "00:-01";
        int innermax=-1;
        float[,] st_price = new float[100, 7];
        tmp = checi.IndexOf(".");
        checi = checi.Substring(0, tmp);
        int en_yz = 0, en_rz = 0, en_yws = 0, en_ywz = 0, en_ywx = 0, en_rws = 0, en_rwx = 0;

        while ((line = sr.ReadLine()) != null)
        {
            Forbid_Flag = 0;
            linei++;
            if (linei == 0) continue;

            in_i = line.Split(',');
            out_i = new string[15];
            for (id = 0; id <= 9; id++)
            {
                in_i[id] = in_i[id].Trim();
            }
            //InnerStation ID
            out_i[0] = in_i[0];
            if (Convert.ToInt32(out_i[0]) > innermax)
                innermax = Convert.ToInt32(out_i[0]);
            //Station Name
            out_i[1] = in_i[1];
            st_name[linei] = in_i[1];
            //到达时间
            if (in_i[2] == "-") out_i[2] = in_i[3];
            else out_i[2] = in_i[2];
            ArriveTime_min = Time2Minint(out_i[2]);
            if (ArriveTime_min < Time2Minint(last_starttimemin)) Delta_day += 1;
            //出发时间
            if (in_i[3] == "-") out_i[3] = in_i[2];
            else out_i[3] = in_i[3];
            StartTime_min = Time2Minint(out_i[3]);

            if (StartTime_min < ArriveTime_min) Delta_day += 1;
            if (Delta_day > 0)
            {
                ArriveTime_min += 1440 * Delta_day;
                StartTime_min += 1440 * Delta_day;
            }
            last_starttimemin = out_i[3];
            st_stimeint[linei] = StartTime_min;
            st_deltaday[linei] = Delta_day;

            //停留时间
            out_i[4] = "";
            //历时
            out_i[5] = "";
            //里程
            if (in_i[6] == "-") out_i[6] = "0";
            else out_i[6] = in_i[6];
            //硬座/软座
            if (in_i[7] == "-")
            {
                out_i[7] = "0";
                out_i[8] = "0";
            }
            else
            {
                tmp = in_i[7].IndexOf('/');
                out_i[7] = in_i[7].Substring(0, tmp);
                out_i[7] = (out_i[7] == "-") ? "0" : out_i[7];
                in_i[7] = in_i[7].Substring(tmp + 1);
                if (in_i[7] == "-")
                {
                    out_i[8] = "0";
                }
                else out_i[8] = in_i[7];

                if (out_i[7] != "0") en_yz = 1;
                if (out_i[8] != "0") en_rz = 1;
            }
            st_price[linei, 0] = Convert.ToSingle(out_i[7]);
            st_price[linei, 1] = Convert.ToSingle(out_i[8]);
            enarr[0] = en_yz;
            enarr[1] = en_rz;

            //硬卧
            if (in_i[8] == "-" || in_i[8] == "//")
            {
                out_i[9] = "0";
                out_i[10] = "0";
                out_i[11] = "0";
            }
            else
            {
                string[] in_i8 = new string[3];
                in_i8 = in_i[8].Split('/');
                out_i[9] = (in_i8[0][0] == '-') ? "0" : in_i8[0];
                out_i[10] = (in_i8[1][0] == '-') ? "0" : in_i8[1];
                out_i[11] = (in_i8[2][0] == '-') ? "0" : in_i8[2];
                if (out_i[9] != "0") en_yws = 1;
                if (out_i[10] != "0") en_ywz = 1;
                if (out_i[11] != "0") en_ywx = 1;
            }
            st_price[linei, 2] = Convert.ToSingle(out_i[9]);
            st_price[linei, 3] = Convert.ToSingle(out_i[10]);
            st_price[linei, 4] = Convert.ToSingle(out_i[11]);
            enarr[2] = en_yws;
            enarr[3] = en_ywz;
            enarr[4] = en_ywx;
            //软卧
            if (in_i[9] == "-" || in_i[9] == "/")
            {
                out_i[12] = "0";
                out_i[13] = "0";
            }
            else
            {
                string[] in_i9 = new string[2];
                in_i9 = in_i[9].Split('/');
                out_i[12] = (in_i9[0][0] == '-') ? "0" : in_i9[0];
                out_i[13] = (in_i9[1][0] == '-') ? "0" : in_i9[1];
                if (out_i[12] != "0") en_rws = 1;
                if (out_i[13] != "0") en_rwx = 1;
            }
            st_price[linei, 5] = Convert.ToSingle(out_i[12]);
            st_price[linei, 6] = Convert.ToSingle(out_i[13]);
            enarr[5] = en_rws;
            enarr[6] = en_rwx;

            if (out_i[7] == "0" && out_i[8] == "0" && out_i[9] == "0" && out_i[10] == "0" && out_i[11] == "0" &&
                out_i[12] == "0" && out_i[13] == "0" && out_i[0]!="1")
                Forbid_Flag = 1;
            st_forbidflag[linei] = Forbid_Flag;

            string line_out = "";
            

            int OuterStationID = FindStationOuterID(in_i[1]);

            line_out = out_i[0] + "," + checi + "," + Convert.ToString(OuterStationID) + ",";

            line_out += out_i[1] + ",";
            line_out += out_i[6] + ",";
            for (id = 7; id <= 13; id++)
            {
                line_out += out_i[id] + ',';
            }
            line_out += Convert.ToString(Delta_day) + ",";
            line_out += out_i[2] + ",";
            line_out += out_i[3] + ",";
            line_out += Convert.ToString(ArriveTime_min) + ",";
            line_out += Convert.ToString(StartTime_min) + ",";
            line_out += Convert.ToString(Forbid_Flag) ;


            out_tsfile[linei] = line_out;

            //Console.WriteLine(line_out); //debug
            //Console.WriteLine(Delta_day);
        }
        //Write trainstation
        for (int i = 1; i <= innermax; i++)
        {
            ts_wr.WriteLine(out_tsfile[i]);
        }
        //Write trainlist
        tl_wr.WriteLine(checi + "," + en_yz + "," + en_rz + "," + en_yws + "," + en_ywz + "," + en_ywx + "," + en_rws + "," + en_rwx);

        //generate random orders
        Random rd = new Random();
        int useri_id = rd.Next(1, users_cnt + 1);
        string useri_idname = useri[useri_id].id;

        int[, , ] seatcount = new int[35, 100, 8];
        for (int day = DATE_FROM; day<= DATE_TO;day++)
            for (int j = 0; j < 7; j++)
                seatcount[day, 1, j] = 0;
        for (int day = DATE_FROM; day <= DATE_TO; day++)
            for (int i = 2; i <= innermax; i++)
                for (int j = 0; j < 7; j++)
                    seatcount[day, i, j] = (enarr[j] == 1)? 5 : 0;
            

        int order_itecnt = rd.Next(0, 100); 
        if (order_itecnt > 20) order_itecnt = 0; //买票概率 20%

        int orderi_startstationinnerid, orderi_endstationinnerid;
        int orderi_souterid, orderi_eouterid;
        int orderi_seattype;
        int orderi_status;
        int orderi_id;
        int orderi_sday;
        int orderi_stimemin;
        int orderi_etimemin;
        int orderi_mincount;
        int orderi_tstartday;
        float orderi_price;
        string orderi_trainid = checi;
        string orderi_userid;
        string orderi_sdate;
        string orderi_tstartdate;
        int[] availableseattype = new int[7];
        int ast_cnt = 0;
        if (en_yz == 1) availableseattype[ast_cnt++] = 0;
        if (en_rz == 1) availableseattype[ast_cnt++] = 1;
        if (en_yws == 1) availableseattype[ast_cnt++] = 2;
        if (en_ywz == 1) availableseattype[ast_cnt++] = 3;
        if (en_ywx == 1) availableseattype[ast_cnt++] = 4;
        if (en_rws == 1) availableseattype[ast_cnt++] = 5;
        if (en_rwx == 1) availableseattype[ast_cnt++] = 6;

        for (int i = 1; i <= order_itecnt; i++)
        {
            orderi_startstationinnerid = rd.Next(1, innermax);
            orderi_endstationinnerid = rd.Next(orderi_startstationinnerid + 1, innermax + 1);
            orderi_souterid = FindStationOuterID(st_name[orderi_startstationinnerid]);
            orderi_eouterid = FindStationOuterID(st_name[orderi_endstationinnerid]);
            orderi_sday = rd.Next(DATE_FROM, DATE_TO + 1);
            if (orderi_sday == 0) continue; //如果17/11/30  不做随机分布
            else orderi_sdate = "2017/12/" + orderi_sday;

            if (st_forbidflag[orderi_startstationinnerid] == 1 || st_forbidflag[orderi_endstationinnerid] == 1) continue; //不让上下车的站 作罢

            
            if (ast_cnt == 0) continue; //所有座位类型都不开 作罢
            orderi_seattype = availableseattype[rd.Next(0, ast_cnt)];
            orderi_price = st_price[orderi_endstationinnerid,orderi_seattype]-st_price[orderi_startstationinnerid,orderi_seattype]+5;
            orderi_mincount = 5;
            for (int j = orderi_startstationinnerid + 1; j <= orderi_endstationinnerid; j++)
            {
                if (orderi_mincount > seatcount[orderi_sday, j, orderi_seattype])
                    orderi_mincount = seatcount[orderi_sday, j, orderi_seattype];
            }
            if (orderi_mincount < 1) continue;
            for (int j = orderi_startstationinnerid + 1; j <= orderi_endstationinnerid; j++)
            {
                seatcount[orderi_sday, j, orderi_seattype]--;
                if (seatcount[orderi_sday, j, orderi_seattype] < 0)
                    Console.WriteLine("WTF?? 怎么可能"); //debug 不存在余座为负数 如果有 将其输出
            }
            orderi_userid = useri_idname;
            orderi_status = rd.Next(0, 2); //只生成[0, 1]状态的order
            orderi_id = ++order_cnt;
            orderi_stimemin = st_stimeint[orderi_startstationinnerid];
            orderi_etimemin = st_stimeint[orderi_endstationinnerid];

            //判断冲突火车（一个人不能同时坐两列火车）
            bool flag = true;
            for (int j = 1; j <= useri[useri_id].order_cnt; j++)
            {
                if ((orderi_sday == useri[useri_id].sday[j]) && (st_stimeint[orderi_startstationinnerid] >= useri[useri_id].stimeint[j]) &&
                    (st_stimeint[orderi_startstationinnerid] <= useri[useri_id].etimeint[j]))
                {
                    flag = false;
                    break;
                }
                if ((orderi_sday == useri[useri_id].sday[j]) && (st_stimeint[orderi_endstationinnerid] >= useri[useri_id].stimeint[j]) &&
                    (st_stimeint[orderi_endstationinnerid] <= useri[useri_id].etimeint[j]))
                {
                    flag = false;
                    break;
                }
                if ((orderi_sday == useri[useri_id].sday[j]) && (st_stimeint[orderi_startstationinnerid] <= useri[useri_id].stimeint[j]) &&
                    (st_stimeint[orderi_endstationinnerid] >= useri[useri_id].etimeint[j]))
                {
                    flag = false;
                    break;
                }
            }
            if (!flag) continue; //冲突车次，则放弃本次order

            orderi_tstartday = orderi_sday - st_deltaday[orderi_startstationinnerid];
            if (orderi_tstartday <= 0) continue;
            orderi_tstartdate = "2017/12/" + orderi_tstartday;

            useri[useri_id].order_cnt++;
            useri[useri_id].sday[useri[useri_id].order_cnt] = orderi_sday;
            useri[useri_id].stimeint[useri[useri_id].order_cnt] = st_stimeint[orderi_startstationinnerid];
            useri[useri_id].etimeint[useri[useri_id].order_cnt] = st_stimeint[orderi_endstationinnerid];
            

            od_wr.WriteLine(orderi_status + "," + orderi_id + "," + orderi_trainid + "," + orderi_sdate + "," +
                            orderi_souterid + "," + orderi_eouterid + "," + orderi_startstationinnerid + "," + orderi_endstationinnerid + "," +
                            orderi_stimemin + "," + orderi_etimemin + "," + 
                            orderi_seattype + "," + orderi_price + "," + orderi_userid + "," + orderi_tstartdate);
        }


        int inner_j;
        string startdate;
        for (int day = DATE_FROM; day <= DATE_TO; day++)
        {
            if (day == 0) startdate = "2017/11/30";
            else startdate = "2017/12/" + day;

            for (inner_j = 1; inner_j <= innermax; inner_j++)
            {
                as_wr.WriteLine(checi + "," + startdate + "," + inner_j + "," + seatcount[day, inner_j, 0] + "," + seatcount[day, inner_j, 1] + "," +
                                seatcount[day, inner_j, 2] + "," + seatcount[day, inner_j, 3] + "," + seatcount[day, inner_j, 4] + "," +
                                seatcount[day, inner_j, 5] + "," + seatcount[day, inner_j, 6]);
            }
        }
    }

    public static void ListFiles(FileSystemInfo info, int param) //循环目录下的所有文件（包括子目录）
    {
        if (!info.Exists) return;

        DirectoryInfo dir = info as DirectoryInfo;
        //不是目录 
        if (dir == null) return;

        FileSystemInfo[] files = dir.GetFileSystemInfos();
        for (int i = 0; i < files.Length; i++)
        {
            FileInfo file = files[i] as FileInfo;
            
            //是文件 
            if (file != null)
            {
                if (file.FullName.IndexOf(".csv") == -1) continue;
                    Wash_filei(file.FullName);
            }
            //对于子目录，进行递归调用 
            else
                ListFiles(files[i], param);

        }
    }

    public static void Record_users()//把users.tbl从磁盘读到内存
    {
        us_rd = new StreamReader(@"E:\ucas\sjk数据库\Lab2\train_v7\data\users.tbl");
        string line = "";
        while ((line = us_rd.ReadLine()) != null)
        {
            string[] linei = line.Split(',');
            useri[++users_cnt].id = linei[0];
            useri[users_cnt].order_cnt = 0;
            useri[users_cnt].sday = new int[200];
            useri[users_cnt].stimeint = new int[200];
            useri[users_cnt].etimeint = new int[200];
        }
    }

    public static void GenerateUsers()//生成users.tbl
    {
        StreamWriter us_wr = new StreamWriter(@"E:\ucas\sjk数据库\Lab2\train_v7\data\users.tbl");
        Random rd = new Random();
        int i;
        bool[] sel = new bool[10000];
        for (i = 0; i < 10000; i++) sel[i] = false;
        for (i = 1; i < 100; i++)
        {
            int useri_id = rd.Next(1, 10000);
            while (sel[useri_id])
                useri_id = rd.Next(1, 10000);
            sel[useri_id] = true;
            int useri_phone = useri_id;
            int useri_card = useri_id;
            string useri_realname = "realname" + i;
            string useri_username = "username" + i;
            us_wr.WriteLine(useri_id + "," + useri_phone + "," + useri_card + "," + useri_username + "," + useri_realname);
            Console.WriteLine(useri_id + "," + useri_phone + "," + useri_card + "," + useri_username + "," + useri_realname);
        }
        us_wr.Close();
    }

    public static void Main()
    {
        ts_wr = new StreamWriter(@"E:\ucas\sjk数据库\Lab2\train_v7\data\trainstation.tbl");
        as_wr = new StreamWriter(@"E:\ucas\sjk数据库\Lab2\train_v7\data\availableseat.tbl");
        tl_wr = new StreamWriter(@"E:\ucas\sjk数据库\Lab2\train_v7\data\trainlist.tbl");
        od_wr = new StreamWriter(@"E:\ucas\sjk数据库\Lab2\train_v7\data\orders.tbl"); //打开所有文件流
        /*使用方法：
         * 
         * 第一步，使用Function3 随机生成99个用户的users.tbl表（如果没有需要可以不加）
         * 第二步，使用Function2 生成trainsofcity表
         * 第三步，使用Function1 生成trainstation表  trainlist表  
         *   注意是随机生成的 orders表 和与之对应的 avilableseat表  如果不需要生成随机orders，把函数里的order_itecnt变量赋0
         *   参数DATA_FROM 和 DATE_TO 规定了生成order表的日期范围
         *   
         * 
         * (里面的数组边界和程序写的不美观 老师见谅)
         */

        /*Function 3: generate random users(100) */
        //GenerateUsers();

        /*Function 1: generate all station_i.tbl*/
        
        Record_users(); //把users.tbl表从磁盘读到内存
        Record_stationlist(); //把trainsofcity表从磁盘读到内存

        DirectoryInfo readFolder = new DirectoryInfo(@"E:\UCAS\sjk数据库\train-2016-10-v4\train-2016-10"); //读取文件流
        ListFiles(readFolder,1);

        /*Function 2: generate trainsofcity.tbl*/
        //Wash_stationlist();

        ts_wr.Close();
        as_wr.Close();
        tl_wr.Close();
        od_wr.Close(); //关闭所有文件流
    }
}
        