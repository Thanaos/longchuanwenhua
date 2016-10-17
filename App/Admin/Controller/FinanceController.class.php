<?php
namespace Admin\Controller;
use Think\Controller;
class FinanceController extends AdminController {
    
    function income(){
        if( $this->act == 'list' ){            //查询会员列表
            if( IS_POST ){
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $where = array('o.order_status'=>2);
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            $service = M('vip_order as o');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('o.*,m.name,m.birthday,m.idCard,m.mobile')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $count_money = $service->where($where)->sum('o.money');
            $this->assign('count_money', $count_money);
            $this->assign('count_member', $count);
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('income_list');
        }
    }
    
    function order(){
        if( $this->act == 'list' ){            //查询会员列表
            if( IS_POST ){
                $start = strtotime(I('start_time'));
                $end = strtotime(I('end_time'));
            }
            $p = intval($_GET['id']) ? intval($_GET['id']) : 1;
            $max = 20;
            $where = array('o.order_status'=>2);
            if( $start > 0 && $end > 0 ){
                $where['o.addtime'] = array('between', array($start, $end));
            }
            $service = M('goods_order as o');
            $count = $service->where($where)->count();
            $Page = new \Think\Page($count, $max);
            $list = $service->join('tp_member as m on o.user_id = m.id', 'left')->where($where)->page($p, $max)->field('o.*,m.name,m.mobile')->select();
            $show['pageCount'] = $Page->totalPages ? $Page->totalPages : 1;
            $show['current'] = $p;
            $count_money = $service->where($where)->sum('o.money');
            $this->assign('count_money', $count_money);
            $this->assign('count_member', $count);
            $this->assign('where', array('start'=>I('start_time'), 'end'=>I('end_time')));
            $this->assign('show', $show);
            $this->assign('list', $list);
            $this->display('order_list');
        }
    }
    
}
