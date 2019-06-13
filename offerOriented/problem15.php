<?php

/**
 * Desc: 查找链表倒数第n个节点
 * User: jiefuyang
 * Date: 2019-06-13
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
        $nextNode    = $pNode->next;
        $pNode->data = $nextNode->data;
        $pNode->next = $nextNode->next;
        unset($nextNode);
    }
}

function findNode(
    $head,
    $nodeIndex
) {
    $length = 0;
    $next   = $head;
    while ($next != null) {
        $next = $next->next;
        $length++;
    }

    if ($head == null || $nodeIndex == null || $nodeIndex <= 0 || $nodeIndex > $length) {
        return false;
    }

    $firstIndex  = 0;
    $secondIndex = 0;
    for ($i = 0; $i < $length; $i++) {
        $firstIndex++;

        if ($firstIndex > $nodeIndex - 1) {
            $secondIndex++;
        }
    }

    $node = $head;
    if ($secondIndex > 0) {
        for ($i = 1; $i < $secondIndex; $i++) {
            $node = $node->next;
        }
    }
    return $node;
}

$head = new Node('a');// 定义头节点
$b    = new Node('b');
$c    = new Node('c');
$d    = new Node('d');
addNode($head, $b);
addNode($head, $c);
addNode($head, $d);

var_dump(findNode($head, 4));