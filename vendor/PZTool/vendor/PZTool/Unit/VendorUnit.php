<?php
/**
 * @date: 23.04.13
 * @time: 17:38
 * @author: Ivan Zaharchenko ( 3axap4eHko@gmail.com )
 * @file: VendorUnit.php
 */


namespace PZTool\Unit;


class VendorUnit extends AbstractUnit
{
    const SOURCE_GIT      = 'git';
    const SOURCE_HG       = 'hg';
    const SOURCE_SVN      = 'svn';
    const SOURCE_COMPOSER = 'composer';

    public function create($source, $type = self::SOURCE_GIT)
    {

        chdir($this->getProjectDirectory());
        chdir(ProjectUnit::DIR_VENDOR);
        switch ($type) {
            case self::SOURCE_GIT:
                exec('git clone ' . $source);
                break;
            case self::SOURCE_HG:
                exec('hg clone ' . $source);
                break;
            case self::SOURCE_SVN:
                exec('svn checkout ' . $source);
                break;
            case self::SOURCE_COMPOSER:
                throw new \Exception('Currently not supported!');
                break;
            default:

        }
    }
}