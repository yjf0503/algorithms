<?php

/**
 * Desc: 二叉树的镜像
 * User: jiefuyang
 * Date: 2019-06-14
 * Time: 10:51
 */

class TreeNode {
    public $data = null;
    public $children = [];
    public $left = null;
    public $right = null;

    public function __construct(string $data) {
        $this->data = $data;
    }

    public function add(TreeNode $node) {
        $this->children[] = $node;
    }

    public function setLeft(TreeNode $child) {
        $this->left = $child;
    }

    public function setRight(TreeNode $child) {
        $this->right = $child;
    }
}


class Tree {
    public $root = null;
    public $result = [];

    public function __construct(TreeNode $root) {
        $this->root = $root;
    }

    public function traverse(
        TreeNode $node,
        $level = 0
    ) {
        if ($node) {
            echo str_repeat('-', $level) . $node->data . PHP_EOL;

            foreach ($node->children as $child) {
                $this->traverse($child, $level + 1);
            }
        }
    }

    public function bfs(TreeNode $root) {
        $result   = array();
        $result[] = $root->data;
        $children = $root->children;
        $temp     = [];

        while (!empty($children)) {
            foreach ($children as $childNode) {
                $result[] = $childNode->data;
                if (!empty($childNode)) {
                    foreach ($childNode->children as $child) {
                        $temp[] = $child;
                    }
                }
            }
            $children = $temp;
            $temp     = [];
        }
        print_r($result);
        echo PHP_EOL;
    }

    public function dfs(TreeNode $root) {
        $result = array();
        $stack  = new SplStack();
        $stack->push($root);

        while ($stack->count() > 0) {
            $current           = $stack->pop();
            $result[]          = $current->data;
            $current->children = array_reverse($current->children);
            foreach ($current->children as $childNode) {
                $stack->push($childNode);
            }
        }
        print_r($result);
        echo PHP_EOL;
    }

    public function dfsRecursive(TreeNode $node) {
        $this->result[] = $node->data;

        if (!empty($node->children)) {
            $node->children = array_reverse($node->children);
            foreach ($node->children as $child) {
                $this->dfsRecursive($child);
            }
        }
        return true;
    }
}

function treeMirror($root) {
    if ($root == null || ($root->left == null && $root->right == null)) {
        return false;
    }

    $temp        = $root->left;
    $root->left  = $root->right;
    $root->right = $temp;

    if ($root->left != null) {
        treeMirror($root->left);
    }

    if ($root->right != null) {
        treeMirror($root->right);
    }

    return $root;
}

$root   = new TreeNode(0);
$child1 = new TreeNode(1);
$root->setLeft($child1);
$child2 = new TreeNode(2);
$child3 = new TreeNode(3);
$child1->setLeft($child2);
$child1->setRight($child3);
$child4 = new TreeNode(4);
$child2->setLeft($child4);
$tree = new Tree($root);


var_dump(treeMirror($root));