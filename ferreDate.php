<?php

class ferreDate
{
    
    /**
     * How many days are there in a month
     * 某月有多少天
     * @param NumberFormatter $year
     * @param NumberFormatter $month
     * @return int|number
     */
    public function dayNum($year, $month)
    {
        if ($year < 1 || $month > 12 || $month < 1) return false;
        return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
    
    /**
     * How many days are there in a year
     * 某年有多少天
     * @param NumberFormatter $year
     */
    public function yearDay($year)
    {
        $days = 0;
        for ($i = 1; $i < 13; $i ++)
        {
            $days += $this->dayNum($year, $i);
        }
        return $days;
    }
    
    /**
     * The exact date of the n day of a year
     * 某年第n天的准确日期
     * Tips:如果想得到其他的日期格式,可取到数据后mktime通过date()函数格式化,如:
     * date('Y-M-D', mktime(0,0,0,$a['year'],$a['month'],$a['day']));
     * @param NumberFormatter $year
     * @param NumberFormatter $days
     * @return array[]
     */
    public function daysForDate($year, $days)
    {
        if ($year < 1 || $days < 1) return false;
        $time = mktime(0, 0, 0, 1, 1, $year) + $days * 86400;                                        //取得UNIX时间戳记
        return ['year' => date('Y', $time), 'month' => date('m', $time), 'day' => date('d', $time)]; //格式化日期输出(数组方式)
    }
    
    /**
     * Calculating the timestamp of the past / future n days
     * 计算过去/未来n天的时间戳
     * @param unknown $days
     */
    public function prevDaysTime($days)
    {
        switch ($days)
        {
            case $days == 0:
                return strtotime('today');            
            default:
                return strtotime(''.$days.' day');
        }
    }
    
    /**
     * Calculate the time stamp of a week / month / quarter / half year / year ago.
     * 计算前一周/一月/一季/半年/一年的时间戳
     * @param unknown $data
     * @param string $type
     * @return number
     */
    public function prevMonYearTime($data, $type = 'week')
    {
        switch ($data)
        {
            case 'week':
                return mktime(0, 0, 0, date('m'), date('d')-7, date('Y'));
            case 'month':
                return mktime(0, 0, 0, date('m')-1, date('d'), date('Y'));
            case 'season':
                return mktime(0, 0, 0, date('m')-3, date('d'), date('Y'));
            case 'half_year':
                return mktime(0, 0, 0, date('m')-6, date('d'), date('Y'));
            case 'year':
                return mktime(0, 0, 0, date('m'), date('d'), date('Y')-1);
        }
    }
    
}
