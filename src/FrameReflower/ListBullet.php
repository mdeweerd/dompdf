<?php
/**
 * @package dompdf
 * @link    https://github.com/dompdf/dompdf
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace Dompdf\FrameReflower;

use Dompdf\FrameDecorator\Block as BlockFrameDecorator;
use Dompdf\FrameDecorator\ListBullet as ListBulletFrameDecorator;

/**
 * Reflows list bullets
 *
 * @package dompdf
 */
class ListBullet extends AbstractFrameReflower
{
    /**
     * ListBullet constructor.
     * @param ListBulletFrameDecorator $frame
     */
    public function __construct(ListBulletFrameDecorator $frame)
    {
        parent::__construct($frame);
    }

    public function reflow(BlockFrameDecorator $block = null)
    {
        if ($block === null) {
            return;
        }

        /** @var ListBulletFrameDecorator */
        $frame = $this->_frame;
        $style = $frame->get_style();

        $style->set_used("width", $frame->get_width());
        $frame->position();

        if ($style->list_style_position === "inside") {
            $block->add_frame_to_line($frame);
        } else {
            $block->add_dangling_marker($frame);
        }
    }
}
