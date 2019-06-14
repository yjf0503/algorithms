<?php

/**
 * Desc: 合并链表
 * User: jiefuyang
 * Date: 2019-06-14
 * Time: 10:51
 */

class Node {
    public $data = '';
    public $next = null;

    function __construct($data) {
        $this->data = $data;
    }
}

// 链表有几个元素
function countNode($head) {
    $cur = $head;
    $i   = 0;
    while (!is_null($cur->next)) {
        ++$i;
        $cur = $cur->next;
    }
    return $i;
}

// 增加节点
function addNode(
    $head,
    $data
) {
    $cur = $head;
    while (!is_null($cur->next)) {
        $cur = $cur->next;
    }
    $cur->next = $data;
}

// 紧接着插在$no后
function insertNode(
    $head,
    $data,
    $no
) {
    if ($no > countNode($head)) {
        return false;
    }
    $cur = $head;
    $new = new Node($data);
    for ($i = 0; $i < $no; $i++) {
        $cur = $cur->next;
    }
    $new->next = $cur->next;
    $cur->next = $new;

}

// 遍历链表
function showNode($head) {
    $cur = $head;
    while (!is_null($cur->next)) {
        echo $cur->data, '<br/>';
        $cur = $cur->next;
    }
}

// 删除第$no个节点
function deleteNode(
    &$pHead,
    $pNode
) {
    if ($pHead == null || $pNode == null) {
        return false;
    }

    if ($pNode->next == null) {
        //链表只有一个节点，并删除这个节点
        if ($pHead == $pNode) {
            $pHead = null;
            return false;
        }

        //删除尾节点，循环删除
        $lastNode = null;
        while ($pHead->data != $pNode->data) {
            $lastNode = $pHead;
            $pHead    = $pHead->next;
        }
        unset($lastNode->next);
        $lastNode->next = null;
    } else {
        //删除头节点或中间节点，做法是将next节点复制到该节点，并删除next节点
        $nextNode = $pNode->next;
        $pNode->data = $nextNode->data;
        $pNode->next = $nextNode->next;
        unset($nextNode);
    }
}

function mergeLists(
    $head1,
    $head2
) {
    if ($head1 == null) {
        return $head2;
    }
    if ($head2 == null) {
        return $head1;
    }

    $newHead = new Node('');
    if ($head1->data < $head2->data) {
        $newHead->data = $head1->data;
        $newHead->next = mergeLists($head1->next, $head2);
    }

    if ($head2->data < $head1->data) {
        $newHead->data = $head2->data;
        $newHead->next = mergeLists($head1, $head2->next);
    }

    return $newHead;
}

$head1 = new Node('1');// 定义头节点
$a     = new Node('3');
$b     = new Node('5');
$c     = new Node('7');
addNode($head1, $a);
addNode($head1, $b);
addNode($head1, $c);

$head2 = new Node('2');// 定义头节点
$d     = new Node('4');
$e     = new Node('6');
$f     = new Node('8');
addNode($head2, $d);
addNode($head2, $e);
addNode($head2, $f);

var_dump(mergeLists($head1, $head2));